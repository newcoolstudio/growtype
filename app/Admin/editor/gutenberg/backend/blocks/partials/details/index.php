<?php

add_filter('render_block', 'growtype_child_render_faq_structured_data', 10, 2);
function growtype_child_render_faq_structured_data($block_content, $block)
{
    if ('core/group' === $block['blockName'] && isset($block['attrs']['className']) && strpos($block['attrs']['className'], 'details-wrapper-faq') !== false) {
        $faq_details = [];
        foreach ($block['innerBlocks'] as $inner_block) {
            if ('core/details' === $inner_block['blockName']) {
                $faq_from_inner_block = growtype_child_extract_faq_from_inner_block($inner_block);
                $faq_details[] = $faq_from_inner_block;
            }
        }

        if (!empty($faq_details)) {
            $faq_json_ld = growtype_child_generate_faq_schema($faq_details);

            return $block_content . $faq_json_ld;
        }
    }

    return $block_content;
}

function growtype_child_extract_faq_from_inner_block($inner_block)
{
    $extract_content_recursively = function ($blocks) use (&$extract_content_recursively) {
        $content = [];

        foreach ($blocks as $block) {
            $innerHTML = trim(strip_tags($block['innerHTML']));
            if (!empty($innerHTML)) {
                $content[] = $innerHTML;
            }

            if (isset($block['innerBlocks']) && !empty($block['innerBlocks'])) {
                $content = array_merge($content, $extract_content_recursively($block['innerBlocks']));
            }
        }

        return $content;
    };

    $faq_content = $extract_content_recursively($inner_block['innerBlocks']);

    $faq_data = [
        'question' => trim(strip_tags($inner_block['innerHTML'])),
        'answer' => implode('. ', $faq_content), // Join content with periods for readability
    ];

    return $faq_data;
}

function growtype_child_generate_faq_schema($faq_data)
{
    $faq_schema = [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => []
    ];

    foreach ($faq_data as $item) {
        $faq_schema['mainEntity'][] = [
            "@type" => "Question",
            "name" => $item['question'],
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => $item['answer']
            ]
        ];
    }

    return '<script type="application/ld+json">' . json_encode($faq_schema) . '</script>';
}

function growtype_child_extract_faq_from_details($block_content)
{
    $dom = new DOMDocument();
    @$dom->loadHTML($block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    $faq_data = [];

    $details = $dom->getElementsByTagName('details');

    foreach ($details as $detail) {
        // Find the <summary> (question) and <p> (answer) elements inside <details>
        $summary = $detail->getElementsByTagName('summary')->item(0);
        $paragraph = $detail->getElementsByTagName('p')->item(0);

        if ($summary && $paragraph) {
            $question = trim($summary->textContent);
            $answer = trim($paragraph->textContent);

            $faq_data[] = [
                'question' => $question,
                'answer' => $answer
            ];
        }
    }

    return $faq_data;
}
