<?php
/**
 * @param $content
 * @return false|string
 */
add_filter('the_content', 'growtype_format_content');
function growtype_format_content($content)
{
    $content = !empty($content) ? mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8") : '';

    if (!empty($content)) {
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(utf8_decode($content));

        $images = $document->getElementsByTagName('img');

        foreach ($images as $img) {
            $existing_class = $img->getAttribute('class');
            $img->setAttribute('class', "img-fluid $existing_class");
        }

        $content = $document->saveHTML();
    }

    return $content;
}

/**
 * Replace default wordpress gallery shortcode
 */
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'growtype_gallery_shortcode');
function growtype_gallery_shortcode($attr)
{
    $post = get_post();
    static $instanceId = 0;
    $instanceId++;

    if (!empty($attr['ids'])) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if (empty($attr['orderby'])) {
            $attr['orderby'] = 'post__in';
        }
        $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ($output != '') {
        return $output;
    }

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby']) {
            unset($attr['orderby']);
        }
    }

    $galleryData = shortcode_atts(array (
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'id' => $post ? $post->ID : 0,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => '',
        'link' => 'file' // CHANGE #1
    ), $attr, 'gallery');

    $galleryId = intval($galleryData['id']);

    $orderby = $galleryData['order'];

    if ('RAND' == $galleryData['order']) {
        $orderby = 'none';
    }

    if (!empty($galleryData['include'])) {
        $_attachments = get_posts([
            'include' => explode(',', $galleryData['include']),
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $galleryData['order'],
            'orderby' => $galleryData['orderby']
        ]);
        $attachments = array ();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif (!empty($exclude)) {
        $attachments = get_children(array ('post_parent' => $galleryId, 'exclude' => $galleryData['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $galleryData['order'], 'orderby' => $orderby));
    } else {
        $attachments = get_children(array ('post_parent' => $galleryId, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $galleryData['order'], 'orderby' => $orderby));
    }

    if (empty($attachments)) {
        return '';
    }

    if (is_feed()) {
        $output = "\n";
        foreach ($attachments as $galleryItemId => $attachment) {
            $output .= growtype_get_attachment_link($instanceId, $galleryItemId, $galleryData['size'], true) . "\n";
        }
        return $output;
    }

    $itemtag = tag_escape($galleryData['itemtag']);
    $captiontag = tag_escape($galleryData['captiontag']);
    $icontag = tag_escape($galleryData['icontag']);
    $valid_tags = wp_kses_allowed_html('post');

    if (!isset($valid_tags[$itemtag])) {
        $itemtag = 'dl';
    }

    if (!isset($valid_tags[$captiontag])) {
        $captiontag = 'dd';
    }

    if (!isset($valid_tags[$icontag])) {
        $icontag = 'dt';
    }

    $columns = intval($galleryData['columns']);
    $itemwidth = $columns > 0 ? floor(100 / $columns) : 100;

    $containerWidthExtra = (2 * 10) . 'px';
    if ($columns == 3) {
        $containerWidthExtra = (3 * 10) . 'px';
    }

    $marginLeft = $columns > 1 ? -(1 * 10) . 'px' : 0 . 'px';

    $float = is_rtl() ? 'right' : 'left';
    $selector = "gallery-{$instanceId}";
    $gallery_style = $gallery_div = '';

    if (apply_filters('use_default_gallery_style', true)) {
        $gallery_style = "
		<style type='text/css'>
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} {
				width: calc(100% + {$containerWidthExtra});
				margin-left: $marginLeft;
			}
		</style>";
    }

    $size_class = sanitize_html_class($galleryData['size']);
    $gallery_div = "<div id='$selector' class='wp-gallery galleryid-{$galleryId} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output = apply_filters('gallery_style', $gallery_style . "\n\t\t" . $gallery_div);

    // NOTE:
    // wp_get_attachment_link =
    // takes ($id = 0, $size = 'thumbnail', $permalink = false, $icon = false, $text = false)
    $i = 0;

    foreach ($attachments as $galleryItemId => $attachment) {
        $image_output = growtype_get_attachment_link($instanceId, $galleryItemId, $galleryData['size'], true, false);

        $image_meta = wp_get_attachment_metadata($galleryItemId);
        $orientation = '';
        if (isset($image_meta['height'], $image_meta['width'])) {
            $orientation = ($image_meta['height'] > $image_meta['width']) ? 'portrait' : 'landscape';
        }
        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";
        if ($captiontag && trim($attachment->post_excerpt)) {
            $output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
    }

    $output .= "
		</div>\n";

    return $output;
}
