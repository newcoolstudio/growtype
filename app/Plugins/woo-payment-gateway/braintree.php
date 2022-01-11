<?php

/**
 * Hide braintree from admin menu section
 */
add_action('admin_head', 'hide_braintree_from_menu');

function hide_braintree_from_menu() {
    echo '<style>
    #toplevel_page_wc_braintree {
      display: none;
    } 
  </style>';
}
