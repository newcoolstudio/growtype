<?php

/**
 * Redirect author pages to home
 */
add_action('template_redirect', 'growtype_template_redirect_author_pages');
function growtype_template_redirect_author_pages()
{
    global $wp_query;

    if (is_author()) {
        wp_redirect(get_option('home'), 301);
        exit;
    }
}
