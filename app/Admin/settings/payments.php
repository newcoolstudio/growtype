<?php

/**
 * Payment options, if payments plugins are active
 */
if (class_exists('Wc_Paysera_Init')) {

    add_action('admin_menu', 'payments_options_page');

    function payments_options_page()
    {
        add_options_page(
            'Payments', // page <title>Title</title>
            'Growtype - Payments', // menu link text
            'manage_options', // capability to access the page
            'payments-options', // page URL slug
            'payments_options_content', // callback function with content
            1 // priority
        );

    }

    function payments_options_content()
    {
        echo '<div class="wrap">
	<h1>Payments options</h1>
	<form method="post" action="options.php">';

        if (class_exists('Wc_Paysera_Init')) {
            settings_fields('payments_paysera_options_settings');
        }

        do_settings_sections('payments-options');
        submit_button();

        echo '</form></div>';
    }
}
