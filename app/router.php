<?php

use function App\sage;

/**
 * Load custom urls
 */
add_filter('generate_rewrite_rules', function ($wp_rewrite) {
    $wp_rewrite->rules = array_merge(
        ['^growtype/documentation/?$' => 'index.php?growtype_documentation=1'],
        ['^growtype/documentation/([^/]+)/?' => 'index.php?growtype_documentation=1&doc_page=$matches[1]'],
        $wp_rewrite->rules
    );
});

add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'growtype_documentation';
    $query_vars[] = 'doc_page';
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

    if (get_query_var('growtype_documentation')) {
        $doc_page = get_query_var('doc_page');

        if (!empty($doc_page)) {
            try {
                echo sage('blade')->render("documentation.content.{$doc_page}.main", []);
            } catch (\Exception $ex) {
                wp_redirect(home_url('growtype/documentation'));
                exit;
            }
        } else {
            echo sage('blade')->render('documentation.index', []);
        }

        exit;
    }
});
