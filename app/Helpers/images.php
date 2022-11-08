<?php
/**
 * @param $object
 * @param $field_name
 * @param $request
 * @return null
 */
function growtype_get_featured_image($post, $size = 'full')
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
function growtype_get_featured_image_tag($post, $size = 'full', $style = 'background-position: center;background-size: cover;background-repeat: no-repeat;')
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
function growtype_get_footer_logo()
{
    return [
        'id' => get_theme_mod('footer_logo'),
        'url' => wp_get_attachment_url(get_theme_mod('footer_logo')) ?? ''
    ];
}

/**
 * @return array
 */
function growtype_get_header_logo()
{
    $logo_url = wp_get_attachment_url(get_theme_mod('header_logo')) ?? '';

    if (is_child_theme() && empty($logo_url)) {
        $logo_url = dirname(get_template_directory_uri()) . '/public/images/logo/growtype.svg';
    }

    return [
        'id' => get_theme_mod('header_logo'),
        'url' => $logo_url
    ];
}

/**
 * @return array
 */
function growtype_get_login_logo()
{
    $logo_url = wp_get_attachment_url(get_theme_mod('login_logo')) ?? '';

    if (empty($logo_url)) {
        $logo_url = wp_get_attachment_url(get_theme_mod('header_logo')) ?? '';
    }

    if (empty($logo_url)) {
        $logo_url = growtype_get_parent_theme_public_path() . '/images/logo/growtype.svg';
    }

    return [
        'id' => get_theme_mod('login_logo'),
        'url' => $logo_url
    ];
}

/**
 * @return array
 */
function growtype_get_header_logo_scroll()
{
    $logo_url = wp_get_attachment_url(get_theme_mod('header_logo_scroll')) ?? '';

    if (is_child_theme() && empty($logo_url)) {
        $logo_url = growtype_get_header_logo()['url'];
    }

    return [
        'id' => get_theme_mod('header_logo_scroll'),
        'url' => $logo_url
    ];
}

/**
 * @return array
 */
function growtype_get_home_page_header_logo()
{
    $logo_url = get_theme_mod('header_logo_home') ? wp_get_attachment_url(get_theme_mod('header_logo_home')) : null;

    if (empty($logo_url)) {
        $logo_url = get_theme_mod('header_logo') ?
            wp_get_attachment_url(get_theme_mod('header_logo')) :
            dirname(get_template_directory_uri()) . '/public/images/logo/growtype.svg';
    }

    return [
        'id' => get_theme_mod('header_logo_home'),
        'url' => $logo_url
    ];
}

/**
 * @return array
 */
function growtype_get_mobile_menu_logo()
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
function growtype_get_panel_logo()
{
    $logo_url = get_theme_mod('panel_logo') ? wp_get_attachment_url(get_theme_mod('panel_logo')) : null;

    return [
        'id' => get_theme_mod('panel_logo'),
        'url' => $logo_url
    ];
}

/**
 * Product gallery sizes
 */
function growtype_wc_get_product_gallery_sizes()
{
    return [
        'thumbnail' => [
            'width' => 100,
            'height' => 100,
            'crop' => 1
        ]
    ];
}

if (!function_exists('growtype_get_icon')) {
    function growtype_get_icon($type, $label = null, $value = null, $is_link = false, $icon = null)
    {
        if ($type === 'email') {
            $value = 'mailto:' . $value;
            if (empty($icon)) {
                $icon = '<span class="dashicons dashicons-email"></span>';
            }
        } elseif ($type === 'phone') {
            $value = 'tel:' . $value;
            if (empty($icon)) {
                $icon = '<span class="dashicons dashicons-phone"></span>';
            }
        } elseif ($type === 'address') {
            $icon = '<span class="dashicons dashicons-admin-home"></span>';
        } elseif ($type === 'facebook') {
            $icon = '<span class="dashicons dashicons-facebook"></span>';
        } elseif ($type === 'instagram') {
            $icon = '<span class="dashicons dashicons-instagram"></span>';
        } elseif ($type === 'website') {
            $icon = '<span class="dashicons dashicons-admin-site"></span>';
        } elseif ($type === 'work_hours') {
            $icon = '<span class="dashicons dashicons-clock"></span>';
        } elseif ($type === 'marker') {
            $icon = '<span class="dashicons dashicons-location"></span>';
        }

        ?>

        <div class="b-contacts-single" data-type="<?php echo $type ?>">
            <?php if ($is_link) { ?>
                <a class="e-link" href="<?php echo str_replace(' ', '', $value) ?>" target="_blank">
                    <?php if (!empty($icon)) { ?>
                        <span class="e-icon"><?php echo $icon ?></span>
                    <?php } ?>
                    <?php if (!empty($label)) { ?>
                        <div class="e-label"><?php echo $label ?></div>
                    <?php } ?>
                </a>
            <?php } else { ?>
                <?php if (!empty($icon)) { ?>
                    <span class="e-icon"><?php echo $icon ?></span>
                <?php } ?>
                <?php if (!empty($label)) { ?>
                    <div class="e-label"><?php echo $label ?></div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php
    }
}
