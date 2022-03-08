<?php
/**
 * @param $object
 * @param $field_name
 * @param $request
 * @return null
 */
function get_featured_image($post, $size = 'full')
{
    if (is_array($post)) {
        return isset($post['id']) ? get_the_post_thumbnail_url($post['id'], 'full') : null;
    } else {
        return get_the_post_thumbnail_url($post->ID, 'full');
    }
}

/**
 * @param $post
 * @param null $defaultImageIsSet
 * @param string $size
 * @param string $extraStyle
 * @return string
 */
function get_featured_image_tag($post, $size = 'full', $style = 'background-position: center;background-size: cover;background-repeat: no-repeat;')
{
    $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
    $feat_img = $feat_img ? $feat_img[0] : '';

    if (empty($feat_img)) {
        $feat_img = $feat_img ? $feat_img[0] : '';
    }

    if (empty($feat_img)) {
        $img_tag = '';
    } else {
        $img_tag = 'background: url(' . $feat_img . ');' . $style;
    }
    return $img_tag;
}

/**
 * @return array
 */
function get_footer_logo()
{
    return [
        'id' => get_theme_mod('footer_logo'),
        'url' => wp_get_attachment_url(get_theme_mod('footer_logo')) ?? ''
    ];
}

/**
 * @return array
 */
function get_header_logo()
{
    $logo_url = wp_get_attachment_url(get_theme_mod('header_logo')) ?? '';

    if (is_child_theme() && empty($logo_url)) {
        $logo_url = dirname(get_template_directory_uri()) . '/public/images/logo/growtype.png';
    }

    return [
        'id' => get_theme_mod('header_logo'),
        'url' => $logo_url
    ];
}

/**
 * @return array
 */
function get_login_logo()
{
    $logo_url = wp_get_attachment_url(get_theme_mod('login_logo')) ?? '';

    if (is_child_theme() && empty($logo_url)) {
        $logo_url = dirname(get_template_directory_uri()) . '/public/images/logo/growtype.png';
    }

    return [
        'id' => get_theme_mod('login_logo'),
        'url' => $logo_url
    ];
}

/**
 * @return array
 */
function get_header_logo_scroll()
{
    $logo_url = wp_get_attachment_url(get_theme_mod('header_logo_scroll')) ?? '';

    if (is_child_theme() && empty($logo_url)) {
        $logo_url = get_header_logo()['url'];
    }

    return [
        'id' => get_theme_mod('header_logo_scroll'),
        'url' => $logo_url
    ];
}

/**
 * @return array
 */
function get_header_logo_home()
{
    $logo_url = get_theme_mod('header_logo_home') ? wp_get_attachment_url(get_theme_mod('header_logo_home')) : null;

    if (empty($logo_url)) {
        $logo_url = get_theme_mod('header_logo') ?
            wp_get_attachment_url(get_theme_mod('header_logo')) :
            dirname(get_template_directory_uri()) . '/public/images/logo/growtype.png';
    }

    return [
        'id' => get_theme_mod('header_logo_home'),
        'url' => $logo_url
    ];
}

/**
 * @return array
 */
function get_mobile_burger_logo()
{
    $logo_url = get_theme_mod('mobile_burger_logo') ? wp_get_attachment_url(get_theme_mod('mobile_burger_logo')) : null;

    if (empty($logo_url)) {
        return null;
    }

    return [
        'id' => get_theme_mod('mobile_burger_logo'),
        'url' => $logo_url
    ];
}

/**
 * @return array
 */
function get_panel_logo()
{
    $logo_url = wp_get_attachment_url(get_theme_mod('panel_logo')) ?? '';

    if (empty($logo_url)) {
        $logo_url = get_theme_mod('header_logo') ?
            wp_get_attachment_url(get_theme_mod('header_logo')) :
            dirname(get_template_directory_uri()) . '/public/images/logo/growtype.png';
    }

    return [
        'id' => get_theme_mod('panel_logo'),
        'url' => $logo_url
    ];
}

/**
 * Product gallery sizes
 */
function get_woocommerce_product_gallery_sizes()
{
    return [
        'thumbnail' => [
            'width' => 100,
            'height' => 100,
            'crop' => 1
        ]
    ];
}
