<?php

class Growtype_Extended_Cpt_Admin
{
    public function __construct()
    {
        add_action('admin_menu', array ($this, 'growtype_extended_cpt_options_page'));
        add_action('admin_init', array ($this, 'growtype_extended_cpt_register_settings'));
    }

    function growtype_extended_cpt_options_page()
    {
        add_options_page(
            'cpt', // page <title>Title</title>
            'Growtype - CPT', // menu link text
            'manage_options', // capability to access the page
            'cpt-options', // page URL slug
            array ($this, 'cpt_options_content'), // callback function with content
            1 // priority
        );
    }

    function cpt_options_content()
    {
        echo '<div class="wrap">
	<h1>CPT options</h1>
	<form method="post" action="options.php">';

        settings_fields('cpt_options_settings'); // settings group name
        do_settings_sections('cpt-options'); // just a page slug
        submit_button();

        echo '</form></div>';
    }

    function growtype_extended_cpt_register_settings()
    {
        $cpt_keys = Growtype_Extended_Cpt::get_keys();

        foreach ($cpt_keys as $cpt_key) {

            $key_name = $cpt_key['name'];
            $key_value = $cpt_key['value'];
            $options = $cpt_key['options'];

            add_settings_section(
                $key_value . '_options_settings', // section ID
                $key_name, // title (if needed)
                '', // callback function (if needed)
                'cpt-options' // page slug
            );

            foreach ($options as $option) {
                register_setting(
                    'cpt_options_settings', // settings group name
                    $key_value . '_' . $option['name'], // option name
                );

                add_settings_field(
                    $key_value . '_' . $option['name'],
                    $option['title'],
                    array ($this, 'input_callback'),
                    'cpt-options',
                    $key_value . '_options_settings',
                    [
                        'type' => $option['type'] ?? 'text',
                        'name' => $key_value . '_' . $option['name'],
                        'default_value' => $option['default_value'] ?? '',
                    ]
                );
            }
        }
    }

    public function input_callback(array $args)
    {
        $name = $args['name'];
        $type = $args['type'];
        $default_value = $args['default_value'];

        if ($type === 'checkbox') {
            $html = '<input type="checkbox" name="' . $name . '" value="1" ' . checked(1, get_option($name), false) . ' />';
        } else {
            $html = '<input type="text" name="' . $name . '" value="' . (!empty(get_option($name)) ? get_option($name) : $default_value) . '"/>';
        }

        echo $html;
    }
}


