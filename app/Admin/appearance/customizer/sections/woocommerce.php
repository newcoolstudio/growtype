<?php

class WC_Shop_Customizer_Extend
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        if (class_exists('woocommerce')) {
            add_action('customize_register', array ($this, 'add_sections'));
            add_action('customize_controls_print_scripts', array ($this, 'add_scripts'), 30);

            $customizer_available_data = new Customizer_Available_Data();
            $this->product_preview_styles = $customizer_available_data->get_available_product_preview_styles();
            $this->available_wc_coupons = $customizer_available_data->get_available_wc_coupons();
        }
    }

    /**
     * Add settings to the customizer.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    public function add_sections($wp_customize)
    {
        if (class_exists('woocommerce')) {
            $wp_customize->get_panel('woocommerce')->title = __('Store', 'growtype');

            $this->add_general_page_section($wp_customize);
            $this->add_coupons_page_section($wp_customize);
            $this->add_product_page_section($wp_customize);
            $this->add_product_preview_section($wp_customize);
            $this->add_thankyou_page_section($wp_customize);
            $this->add_email_section($wp_customize);
            $this->add_wishlist_section($wp_customize);
            $this->add_cart_section($wp_customize);
            $this->add_account_section($wp_customize);
            $this->extend_product_catalog_page_section($wp_customize);
            $this->extend_checkout_page_section($wp_customize);
        }
    }

    /**
     * @param $wp_customize
     */
    public function add_general_page_section($wp_customize)
    {
        require_once 'woocommerce/general.php';
    }

    /**
     * @param $wp_customize
     */
    public function add_coupons_page_section($wp_customize)
    {
        require_once 'woocommerce/coupons.php';
    }

    /**
     * @param $wp_customize
     */
    public function add_product_page_section($wp_customize)
    {
        require_once 'woocommerce/product.php';
    }

    /**
     * Thank you page
     */

    /**
     * @param $wp_customize
     */
    public function add_thankyou_page_section($wp_customize)
    {
        require_once 'woocommerce/thankyou.php';
    }

    /**
     * @param $wp_customize
     * Email section
     */
    public function add_wishlist_section($wp_customize)
    {
        require_once 'woocommerce/wishlist.php';
    }

    /**
     * @param $wp_customize
     * Email section
     */
    public function add_cart_section($wp_customize)
    {
        require_once 'woocommerce/cart.php';
    }

    /**
     * @param $wp_customize
     * Email section
     */
    public function add_account_section($wp_customize)
    {
        require_once 'woocommerce/account.php';
    }

    /**
     * @param $wp_customize
     * Email section
     */
    public function add_product_preview_section($wp_customize)
    {
        require_once 'woocommerce/product-preview.php';
    }

    /**
     * @param $wp_customize
     * Email section
     */
    public function add_email_section($wp_customize)
    {
        require_once 'woocommerce/email.php';
    }

    /**
     * @param $wp_customize
     */
    public function extend_product_catalog_page_section($wp_customize)
    {
        require_once 'woocommerce/catalog.php';
    }

    /**
     * @param $wp_customize
     */
    public function extend_checkout_page_section($wp_customize)
    {
        require_once 'woocommerce/checkout.php';
    }

    /**
     * Scripts to improve sections.
     */
    public function add_scripts()
    {
        $args = array (
            'post_type' => 'product',
            'posts_per_page' => 1
        );

        $query = new WP_Query($args);

        $productPageUrl = '#';

        while ($query->have_posts()) : $query->the_post();
            global $product;
            $productPageUrl = get_permalink();
        endwhile;

        wp_reset_query();

        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                wp.customize.section('woocommerce_product_page', function (section) {
                    section.expanded.bind(function (isExpanded) {
                        if (isExpanded) {
                            wp.customize.previewer.previewUrl.set('<?php echo esc_js($productPageUrl); ?>');
                        }
                    });
                });
            });
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                wp.customize.section('woocommerce_thankyou_page', function (section) {
                    section.expanded.bind(function (isExpanded) {
                        if (isExpanded) {
                            wp.customize.previewer.previewUrl.set('<?php echo home_url('/documentation/examples/payment/success') ?>');
                        }
                    });
                });
            });
        </script>
        <script type="text/javascript">
            window.preview_order_id = '<?php echo get_user_first_order() ? get_user_first_order()->get_id() : '';?>'
            jQuery(document).ready(function ($) {
                wp.customize.section('woocommerce_email_page', function (section) {
                    section.expanded.bind(function (isExpanded) {
                        if (isExpanded) {
                            var template = $('#customize-control-woocommerce_email_page_template select').val();
                            var templateUrl = '<?php echo home_url('/documentation/examples/email/preview?email_type=WC_Email_Customer_Processing_Order&order_id=' . (get_user_first_order() ? get_user_first_order()->get_id() : '')); ?>';
                            templateUrl = templateUrl.replace("WC_Email_Customer_Processing_Order", template);
                            wp.customize.previewer.previewUrl(templateUrl);
                            $("#sub-accordion-section-woocommerce_email_page li[id*='main_content']").hide();
                            $("#sub-accordion-section-woocommerce_email_page li[id*=" + template.toLowerCase() + "]").show();
                        }
                    });
                });
            });
        </script>
        <?php
    }
}

new WC_Shop_Customizer_Extend();

/**
 * @param $checked
 * Translate text input textarea
 */
function woocommerce_thankyou_page_intro_content_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mod('woocommerce_thankyou_page_intro_content');
        return formatTranslation($translation, $value, true);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text input textarea
 */
function woocommerce_thankyou_page_intro_content_access_platform_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mod('woocommerce_thankyou_page_intro_content_access_platform');
        return formatTranslation($translation, $value, true);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text input textarea
 */
function woocommerce_product_page_sidebar_content_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mod('woocommerce_product_page_sidebar_content');
        return formatTranslation($translation, $value, true);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text input textarea
 */
function woocommerce_product_page_payment_details_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mod('woocommerce_product_page_payment_details');
        return formatTranslation($translation, $value, true);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text input copyright
 */
function woocommerce_checkout_billing_section_title_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["woocommerce_checkout_billing_section_title"];
        return formatTranslation($translation, $value);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text input copyright
 */
function woocommerce_checkout_additional_section_title_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["woocommerce_checkout_additional_section_title"] ?? '';
        return formatTranslation($translation, $value);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text input copyright
 */
function woocommerce_checkout_account_section_title_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["woocommerce_checkout_account_section_title"] ?? '';
        return formatTranslation($translation, $value);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text input copyright
 */
function woocommerce_checkout_place_order_button_title_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["woocommerce_checkout_place_order_button_title"];
        return formatTranslation($translation, $value);
    }

    return $value;
}


/**
 * @param $checked
 * Translate text input copyright
 */
function woocommerce_thankyou_page_intro_title_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["woocommerce_thankyou_page_intro_title"];
        return formatTranslation($translation, $value);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text input copyright
 */
function woocommerce_checkout_intro_text_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["woocommerce_checkout_intro_text"];
        return formatTranslation($translation, $value);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text input copyright
 */
function woocommerce_product_preview_cta_label_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["woocommerce_product_preview_cta_label"];
        return formatTranslation($translation, $value);
    }

    return $value;
}
