<?php

/**
 * Photoswipe
 */
add_filter('woocommerce_single_product_photoswipe_options', 'growtype_woocommerce_single_product_photoswipe_options');
function growtype_woocommerce_single_product_photoswipe_options($options)
{
    $options['captionEl'] = false;
    // Other options
    // $options['shareEl'] = true;
    // $options['counterEl'] = false;
    // $options['arrowEl'] = false;
    // $options['preloaderEl'] = true; // For browsers that do not support CSS animations
    // $options['closeOnScroll'] = false; // Already defaults to false
    // $options['clickToCloseNonZoomable'] = false;
    // $options['closeOnVerticalDrag'] = false;
    // $options['maxSpreadZoom'] = 1;
    // $options['hideAnimationDuration'] = 500;
    // $options['showAnimationDuration'] = 500;
    // $options['barsSize'] = array("top" => 0, "bottom" => "auto");
    return $options;
}

/**
 * Woocommerce single page main img dimensions
 */
add_filter('woocommerce_get_image_size_single', 'growtype_woocommerce_set_image_size');
add_filter('woocommerce_get_image_size_shop_single', 'growtype_woocommerce_set_image_size');
add_filter('woocommerce_get_image_size_woocommerce_single', 'growtype_woocommerce_set_image_size');
function growtype_woocommerce_set_image_size()
{
    return array (
        'width' => !empty(get_option('single_page_gallery_main_img_width')) ? get_option('single_page_gallery_main_img_width') : 600,
        'height' => !empty(get_option('single_page_gallery_main_img_height')) ? get_option('single_page_gallery_main_img_height') : 700,
        'crop' => get_theme_mod('single_page_gallery_main_img_cropped') === false ? 0 : 1,
    );
}

/**
 * Flexslider
 */
add_filter('woocommerce_single_product_carousel_options', 'growtype_woocommerce_single_product_carousel_options');
function growtype_woocommerce_single_product_carousel_options($options)
{
    $options['directionNav'] = true;
    if (wp_is_mobile()) {
        $options['controlNav'] = false; // Option 'thumbnails' by default
//        $options['smoothHeight'] = true; // Already "true" by default
//        $options['animation'] = "slide"; // Already "slide" by default
//        $options['slideshow'] = false; // Already "false" by default
//        $options['touch'] = false; // Already "false" by default
    }
    return $options;
}

/**
 * Woocommerce image size thumbnail
 */
add_filter('woocommerce_get_image_size_gallery_thumbnail', 'growtype_woocommerce_get_image_size_gallery_thumbnail', 10, 3);
function growtype_woocommerce_get_image_size_gallery_thumbnail($zoom_options)
{
    return array (
        'width' => growtype_wc_get_product_gallery_sizes()['thumbnail']['width'],
        'height' => growtype_wc_get_product_gallery_sizes()['thumbnail']['height'],
        'crop' => growtype_wc_get_product_gallery_sizes()['thumbnail']['crop'],
    );
}

/**
 * Remove zoom on hover
 */
add_filter('woocommerce_single_product_zoom_options', 'growtype_woocommerce_single_product_zoom_options', 10, 3);
function growtype_woocommerce_single_product_zoom_options($zoom_options)
{
    $zoom_options = array (
        'url' => false,
        'callback' => false,
        'target' => false,
        'duration' => 120, // Transition in milli seconds (default is 120)
        'on' => 'click', // other options: grab, click, toggle (default is mouseover)
        'touch' => false, // enables a touch fallback
        'onZoomIn' => false,
        'onZoomOut' => false,
        'magnify' => wp_is_mobile() ? 0 : 0, // Zoom magnification: (default is 1  |  float number between 0 and 1)
    );

    return $zoom_options;
}

/**
 * Hide zoom icon
 */
add_action('wp', 'growtype_woocommerce_single_product_gallery_zoom_icon', 100);
function growtype_woocommerce_single_product_gallery_zoom_icon()
{
    if (!get_theme_mod('woocommerce_product_page_gallery_trigger_icon', false)) {
        remove_theme_support('wc-product-gallery-zoom');
    }
}

/**
 * Lightbox
 */
add_action('wp', 'growtype_woocommerce_single_product_gallery_lightbox', 99);
function growtype_woocommerce_single_product_gallery_lightbox()
{
    if (!get_theme_mod('woocommerce_product_page_gallery_lightbox', true)) {
        remove_theme_support('wc-product-gallery-lightbox');
    }
}
