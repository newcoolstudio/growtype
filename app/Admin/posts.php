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

/*
 * Change post elements
 */

//add_action('init', 'revcon_change_post_object');
//function revcon_change_post_object()
//{
//    $label_title = 'Post';
//    global $wp_post_types;
//    $labels = &$wp_post_types['post']->labels;
//    $labels->name = $label_title;
//    $labels->singular_name = $label_title;
//    $labels->add_new = 'Add ' . $label_title;
//    $labels->add_new_item = 'Add ' . $label_title;
//    $labels->edit_item = 'Edit ' . $label_title;
//    $labels->new_item = $label_title;
//    $labels->view_item = 'View ' . $label_title;
//    $labels->search_items = 'Search ' . $label_title;
//    $labels->not_found = 'No ' . $label_title . 'found';
//    $labels->not_found_in_trash = 'No ' . $label_title . 'found in Trash';
//    $labels->all_items = 'All ' . $label_title;
//    $labels->menu_name = $label_title;
//    $labels->name_admin_bar = $label_title;
//}

//add_action( 'admin_menu', 'remove_default_post_type' );
//function remove_default_post_type() {
//    remove_menu_page( 'edit.php' );
//}
//
//add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );
//function remove_default_post_type_menu_bar( $wp_admin_bar ) {
//    $wp_admin_bar->remove_node( 'new-post' );
//}

//add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );
//function remove_draft_widget(){
//    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
//}
