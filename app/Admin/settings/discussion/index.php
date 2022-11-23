<?php

class Growtype_Admin_Settings_Discussion
{
    public function __construct()
    {
        add_action('admin_init', array ($this, 'admin_settings'));
    }

    public function admin_settings()
    {
        add_settings_section(
            'comments_fully_disabled_id',
            'Growtype - Extra Settings',
            array ($this, 'extra_description'),
            'discussion'
        );

        register_setting(
            'discussion',
            'comments_fully_disabled',
            'trim'
        );

        add_settings_field(
            'comments_fully_disabled',
            'Comments fully disabled',
            array ($this, 'show_settings'),
            'discussion',
            'comments_fully_disabled_id',
            array ('label_for' => 'comments_fully_disabled_id')
        );
    }

    /**
     * Print the text before our field.
     */
    function extra_description()
    {
        ?>
        <p class="description">Extra settings for discussion</p>
        <?php
    }

    /**
     * Show our field.
     *
     * @param array $args
     */
    function show_settings($args)
    {
        $disabled = get_option('comments_fully_disabled') ?? 1;
        $html = '<input type="checkbox" name="comments_fully_disabled" value="1" ' . checked(1, $disabled, false) . ' />';
        echo $html;
    }
}

new Growtype_Admin_Settings_Discussion();
