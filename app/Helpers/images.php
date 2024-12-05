<?php

/**
 * @param $post
 * @param null $defaultImageIsSet
 * @param string $size
 * @param string $extraStyle
 * @return string
 */
if (!function_exists('growtype_get_featured_image_tag')) {
    function growtype_get_featured_image_tag($post_id, $size = 'full', $style = 'background-position: center;background-size: cover;background-repeat: no-repeat;')
    {
        $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
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
}

/**
 * @return array
 */
if (!function_exists('growtype_get_footer_logo')) {
    function growtype_get_footer_logo()
    {
        $logo_details = [
            'id' => get_theme_mod('footer_logo'),
            'url' => wp_get_attachment_url(get_theme_mod('footer_logo')) ?? ''
        ];

        return apply_filters('growtype_footer_logo', $logo_details);
    }
}

/**
 * @return array
 */
if (!function_exists('growtype_get_header_logo')) {
    function growtype_get_header_logo()
    {
        if (growtype_is_home_page()) {
            $logo_details = growtype_get_home_page_header_logo();
        } else {
            $logo_details = growtype_get_default_header_logo();
        }

        return apply_filters('growtype_header_logo', $logo_details);
    }
}

/**
 * @return string
 */
if (!function_exists('growtype_get_header_logo_url')) {
    function growtype_get_header_logo_url()
    {
        return growtype_get_header_logo()['url'] ?? '';
    }
}

/**
 * @return array
 */
if (!function_exists('growtype_get_default_header_logo')) {
    function growtype_get_default_header_logo()
    {
        $logo_url = !empty(get_theme_mod('header_logo')) ? wp_get_attachment_url(get_theme_mod('header_logo')) : null;

        if (is_child_theme() && empty($logo_url)) {
            $logo_url = dirname(get_template_directory_uri()) . '/public/images/logo/growtype.svg';
        }

        return [
            'id' => get_theme_mod('header_logo'),
            'url' => $logo_url
        ];
    }
}

/**
 * @return array
 */
if (!function_exists('growtype_get_home_page_header_logo')) {
    function growtype_get_home_page_header_logo()
    {
        $logo_url = !empty(get_theme_mod('header_logo_home')) ? wp_get_attachment_url(get_theme_mod('header_logo_home')) : null;

        if (empty($logo_url)) {
            $logo_url = growtype_get_default_header_logo()['url'];
        }

        return [
            'id' => get_theme_mod('header_logo_home'),
            'url' => apply_filters('growtype_home_page_header_logo_url', $logo_url)
        ];
    }
}

/**
 * @return array
 */
if (!function_exists('growtype_get_header_logo_mobile')) {
    function growtype_get_header_logo_mobile()
    {
        $logo_url = !empty(get_theme_mod('header_logo_mobile')) ? wp_get_attachment_url(get_theme_mod('header_logo_mobile')) : null;
        $logo_url = apply_filters('growtype_header_logo_mobile_url', $logo_url);

        return [
            'id' => get_theme_mod('header_logo'),
            'url' => $logo_url
        ];
    }
}

/**
 * @return string
 */
if (!function_exists('growtype_get_header_logo_mobile_url')) {
    function growtype_get_header_logo_mobile_url()
    {
        return growtype_get_header_logo_mobile()['url'] ?? '';
    }
}

/**
 * @return array
 */
if (!function_exists('growtype_get_login_logo')) {
    function growtype_get_login_logo()
    {
        $logo_url = !empty(get_theme_mod('login_logo')) ? wp_get_attachment_url(get_theme_mod('login_logo')) : null;

        if (empty($logo_url)) {
            $logo_url = growtype_get_header_logo()['url'];
        }

        if (empty($logo_url)) {
            $logo_url = growtype_get_parent_theme_public_path() . '/images/logo/growtype.svg';
        }

        return [
            'id' => get_theme_mod('login_logo'),
            'url' => $logo_url
        ];
    }
}

/**
 * @return array
 */
if (!function_exists('growtype_get_header_logo_scroll')) {
    function growtype_get_header_logo_scroll()
    {
        $logo_url = !empty(get_theme_mod('header_logo_scroll')) ? wp_get_attachment_url(get_theme_mod('header_logo_scroll')) : null;

        if (is_child_theme() && empty($logo_url)) {
            $logo_url = growtype_get_header_logo()['url'];
        }

        $logo_details = [
            'id' => get_theme_mod('header_logo_scroll'),
            'url' => $logo_url
        ];

        return apply_filters('growtype_header_logo_scroll', $logo_details);
    }
}

/**
 * @return array
 */
if (!function_exists('growtype_get_header_logo_mobile_scroll')) {
    function growtype_get_header_logo_mobile_scroll()
    {
        $logo_url = !empty(get_theme_mod('header_logo_mobile_scroll')) ? wp_get_attachment_url(get_theme_mod('header_logo_mobile_scroll')) : null;

        if (is_child_theme() && empty($logo_url)) {
            $logo_url = growtype_get_header_logo_mobile()['url'];
        }

        $logo_details = [
            'id' => get_theme_mod('header_logo_mobile_scroll'),
            'url' => $logo_url
        ];

        return apply_filters('growtype_header_logo_mobile_scroll', $logo_details);
    }
}

/**
 * @return string
 */
if (!function_exists('growtype_get_header_logo_scroll_url')) {
    function growtype_get_header_logo_scroll_url()
    {
        return growtype_get_header_logo_scroll()['url'] ?? '';
    }
}

/**
 * @return string
 */
if (!function_exists('growtype_get_header_logo_mobile_scroll_url')) {
    function growtype_get_header_logo_mobile_scroll_url()
    {
        return growtype_get_header_logo_mobile_scroll()['url'] ?? '';
    }
}

/**
 * @return array
 */
if (!function_exists('growtype_get_mobile_menu_logo')) {
    function growtype_get_mobile_menu_logo()
    {
        $logo_url = !empty(get_theme_mod('mobile_burger_logo')) ? wp_get_attachment_url(get_theme_mod('mobile_burger_logo')) : null;

        if (empty($logo_url)) {
            return null;
        }

        return [
            'id' => get_theme_mod('mobile_burger_logo'),
            'url' => $logo_url
        ];
    }
}

/**
 * Get panel (sidebar alternative) main logo
 */
if (!function_exists('growtype_get_panel_logo')) {
    function growtype_get_panel_logo()
    {
        $logo_url = !empty(get_theme_mod('panel_logo')) ? wp_get_attachment_url(get_theme_mod('panel_logo')) : null;

        return [
            'id' => get_theme_mod('panel_logo'),
            'url' => $logo_url
        ];
    }
}

/**
 * Get icon component
 */
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

/**
 * Get attachment link
 */
if (!function_exists('growtype_get_attachment_link')) {
    function growtype_get_attachment_link($instanceId, $galleryItemId = 0, $size = 'thumbnail', $permalink = true, $icon = false, $text = false)
    {
        $id = intval($galleryItemId);
        $_post = get_post($id);

        if (empty($_post) || ('attachment' != $_post->post_type) || !$url = wp_get_attachment_url($_post->ID)) {
            return __('Missing Attachment');
        }

        if ($permalink)
            // $url = get_attachment_link( $_post->ID ); // we want the "large" version!!
            // FIX!! ask for large URL
        {
            $image_attributes = wp_get_attachment_image_src($_post->ID, 'large');
        }

        $url = $image_attributes[0];
        //		$url = wp_get_attachment_image( $_post->ID, 'large' );
        $post_title = esc_attr($_post->post_title);

        if ($text) {
            $link_text = $text;
        } elseif ($size && 'none' != $size) {
            $link_text = wp_get_attachment_image($id, $size, $icon);
        } else {
            $link_text = '';
        }

        if (trim($link_text) == '') {
            $link_text = $_post->post_title;
        }

        return apply_filters('wp_get_attachment_link', "<a class='fancybox' href='$url' rel='gallery-nr-$instanceId'>$link_text</a>", $id, $size, $permalink, $icon, $text);
    }
}
