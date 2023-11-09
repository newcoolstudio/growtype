<?php

namespace App;

/**
 * Php error message
 */
add_filter('wp_php_error_message', function ($message, $error) {
    return sprintf(__('Something has gone wrong on our website, and it is currently experiencing a critical issue. Please inform us at <a href="mailto:%1$s">%1$s</a>. We appreciate your understanding and support.', 'growtype'), get_option('admin_email'));
}, 10, 2);

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar_primary()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/', '/\/resources/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'growtype') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index',
    '404',
    'archive',
    'author',
    'category',
    'tag',
    'taxonomy',
    'date',
    'home',
    'frontpage',
    'page',
    'paged',
    'search',
    'single',
    'singular',
    'attachment',
    'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__ . '\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("growtype/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory() . '/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {

    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("growtype/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory() . '/index.php';
    }

    return $comments_template;
}, 100);

/**
 * WP - Load JS Asynchronously
 * Eliminate blocking-resources
 */
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    $async_loading = array (
        'gutenberg-block-editor-scripts',
        'swiperJS',
        'easyTicker',
        'ap-block-posts-script',
    );

    if (in_array($handle, $async_loading)) {
        $tag = '<script async type="text/javascript" src="' . esc_url($src) . '"></script>';
    }

    return $tag;
}, 10, 3);

/**
 * WP - Load CSS Asynchronously
 * Eliminate blocking-resources
 */
add_filter('style_loader_tag', function ($html, $handle) {
    $async_loading = array (
        'wp-block-library',
        'wp-block-editor',
        'wp-nux',
        'wp-editor',
        'wp-components',
        'dashicons',
        'ap-block-posts-style',
        'wp-reusable-blocks',
        'carousel-block',
        'jquery-fancybox-style',
        'chosen-style',
        'slick-min-style',
        'growtype-app-style',
    );

    if (in_array($handle, $async_loading)) {
        $async_html = str_replace("rel='stylesheet'", "rel='preload' as='style'", $html);
        $async_html .= str_replace('media=\'all\'', 'media="print" onload="this.media=\'all\'"', $html);
        return $async_html;
    }

    return $html;
}, 10, 2);

/**
 * Alter theme file paths. Keep some paths unchanged
 */
add_filter('theme_file_path', function ($url, $path) {
    if (in_array($path, ['theme.json'])) {
        return $url;
    }

    return pathinfo($url, PATHINFO_DIRNAME);
}, 1, 2);
