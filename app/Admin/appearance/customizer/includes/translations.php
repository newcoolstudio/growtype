<?php

/**
 * @param $translation
 * @param $value
 * @return mixed|string
 */
function formatTranslation($translation, $value, $applyHtmlFormating = false)
{
    $enabled_languages = get_option('qtranslate_enabled_languages');
    $translatedValuesBlocks = qtranxf_get_language_blocks($translation);
    $translatedValues = qtranxf_split_blocks($translatedValuesBlocks);
    $translatedValues[$_COOKIE['qtrans_front_language']] = $value;

    if ($applyHtmlFormating) {
        $translatedValues[$_COOKIE['qtrans_front_language']] = wpautop($value);
    }

    foreach ($enabled_languages as $index => $language) {
        $translatedValues[$language] = isset($translatedValues[$language]) ? $translatedValues[$language] : '';
    }

    $translatedValues = qtranxf_join_b($translatedValues);

    return $translatedValues;
}

/**
 * Qtranslate fields parcing
 */
function qtranslate_fields_parse()
{
    $result = '';
    if (function_exists('qtrans_getLanguage')) {
        $themeMods = get_theme_mods();

        $themeModsValuesArray = [
            'footer_copyright',
            'footer_textarea',
            'header_navbar_text',
            'theme_general_gdpr_content',
            'woocommerce_product_page_payment_details',
            'woocommerce_checkout_billing_section_title',
            'woocommerce_checkout_additional_section_title',
            'woocommerce_checkout_account_section_title',
            'woocommerce_checkout_place_order_button_title',
            'woocommerce_checkout_intro_text',
            'woocommerce_thankyou_page_intro_title',
            'woocommerce_thankyou_page_intro_content',
            'woocommerce_thankyou_page_intro_content_disabled_account',
            'woocommerce_product_preview_cta_label',
            'header_extra_content',
        ];

        $themeModsValues = [];
        foreach ($themeModsValuesArray as $themeModsValue) {
            $themeModsValues[$themeModsValue] = $themeMods[$themeModsValue] ?? '';
        }

        $translatedValues = [];
        foreach ($themeModsValues as $key => $value) {
            $blocks = qtranxf_get_language_blocks($value);
            $texts = qtranxf_split_blocks($blocks);
            $translatedValues[$key] = $texts[$_COOKIE['qtrans_front_language']];
        }

        $result = $translatedValues;
    }

    echo json_encode($result);
    exit();
}

add_action('wp_ajax_qtranslate_fields_parse', 'qtranslate_fields_parse');
add_action('wp_ajax_nopriv_qtranslate_fields_parse', 'qtranslate_fields_parse');
