<?php

use function App\sage;

/**
 * Load custom urls
 */
add_filter('generate_rewrite_rules', function ($wp_rewrite) {
    $wp_rewrite->rules = array_merge(
        ['^growtype/documentation/examples/([^/]*)/?/([^/]*)/?' => 'index.php?example_category=$matches[1]&example_type=$matches[2]'],
        $wp_rewrite->rules
    );
});

add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'example_category';
    $query_vars[] = 'example_type';
    return $query_vars;
});

/**
 * Template redirect
 */
add_action('template_redirect', function () {
    /**
     * Check if user should be redirected to specific url.
     */
    growtype_custom_page_redirect();

    /**
     * Load example templates
     */
    $example_category = get_query_var('example_category');
    $example_type = get_query_var('example_type');
    if ($example_category && $example_type) {
        $url_path = trim(parse_url(add_query_arg(array ()), PHP_URL_PATH), '/');
        $url_path = str_replace('growtype/', '', $url_path);

        try {
            echo sage('blade')->render($url_path, []);
        } catch (\Exception $ex) {
            wp_redirect(home_url());
        }
        exit;
    }
});
