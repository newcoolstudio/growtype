<?php

/**
 * Google maps api
 */
function my_acf_init() {

    acf_update_setting('google_api_key', get_option('acf_maps_api_key_value'));
}

add_action('acf/init', 'my_acf_init');

/**
 * Options page
 */
if( function_exists('acf_add_options_page') ) {
//    acf_add_options_page();
}

/**
 * Add styles to acf blocks
 */
add_action('admin_head', 'acf_styles');

function acf_styles()
{
    echo '<style>
    .acf-flexible-content .layout:nth-child(odd) {
background: rgb(247, 247, 247);
}
  </style>';
}

/**
 * Dynamically populate fields
 */
add_filter('acf/load_field/name=unique_id_is_not_f_editable', function($field) {
    $field['default_value'] = __('s-' . base64_encode(random_bytes(9)), 'growtype');
    return $field;
});