<?php

/**
 * @param $existing_value
 * @param $value
 * @return mixed|string
 */
function growtype_format_translation($current_lang, $existing_value, $new_value, $apply_html_formatting = false)
{
    $enabled_languages = get_option('qtranslate_enabled_languages');
    $translatedValuesBlocks = qtranxf_get_language_blocks($existing_value);
    $translatedValues = qtranxf_split_blocks($translatedValuesBlocks);
    $translatedValues[$current_lang] = $new_value;

    if ($apply_html_formatting) {
        $translatedValues[$current_lang] = wpautop($new_value);
    }

    foreach ($enabled_languages as $index => $language) {
        $translatedValues[$language] = isset($translatedValues[$language]) ? $translatedValues[$language] : '';
    }

    $translatedValues = qtranxf_join_b($translatedValues);

    return $translatedValues;
}

/**
 * Qtranslate custom fields parsing
 */
add_action('wp_ajax_qtranslate_fields_parse', 'growtype_wp_ajax_qtranslate_fields_parse');
add_action('wp_ajax_nopriv_qtranslate_fields_parse', 'growtype_wp_ajax_qtranslate_fields_parse');
function growtype_wp_ajax_qtranslate_fields_parse()
{
    $result = '';
    if (class_exists('QTX_Translator')) {
        $themeMods = get_theme_mods();

        /**
         * Blog name
         */
        $themeMods['blogname'] = get_bloginfo();

        /**
         * Keys to translate
         */
        $themeModsValuesArray = [
            'blogname',
            'footer_copyright',
            'footer_textarea',
            'header_navbar_text',
            'theme_general_gdpr_content',
            'theme_general_created_by_content',
            'woocommerce_product_page_payment_details',
            'woocommerce_checkout_billing_section_title',
            'woocommerce_checkout_additional_section_title',
            'woocommerce_checkout_account_section_title',
            'woocommerce_checkout_place_order_button_title',
            'woocommerce_checkout_intro_text',
            'woocommerce_thankyou_page_intro_title',
            'woocommerce_thankyou_page_intro_content',
            'woocommerce_thankyou_page_intro_content_access_platform',
            'woocommerce_product_page_sidebar_content',
            'woocommerce_product_preview_cta_label',
            'header_extra_content',
            'header_promo_content',
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

/**
 * Sanitize blogname
 */
add_action('customize_sanitize_blogname', 'growtype_customize_sanitize_blogname', 100);
function growtype_customize_sanitize_blogname($new_value)
{
    $existing_value = get_option('blogname');

    return growtype_format_translation($_COOKIE['qtrans_front_language'], $existing_value, $new_value);
}

