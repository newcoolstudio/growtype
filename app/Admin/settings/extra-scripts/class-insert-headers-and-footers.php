<?php

/**
 * Insert Headers and Footers Classes
 */
class Growtype_Insert_Headers_And_Footers
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plugin = new stdClass;
        $this->plugin->name = 'insert-headers-and-footers'; // Plugin Folder
        $this->plugin->displayName = 'Growtype - Extra Scripts'; // Plugin Name
        $this->plugin->version = '1.0';
        $this->plugin->folder = plugin_dir_path(__FILE__);
        $this->plugin->url = plugin_dir_url(__FILE__);
        $this->plugin->db_welcome_dismissed_key = $this->plugin->name . '_welcome_dismissed_key';
        $this->body_open_supported = function_exists('wp_body_open') && version_compare(get_bloginfo('version'), '5.2', '>=');

        // Hooks
        add_action('admin_init', array (&$this, 'registerSettings'));
        add_action('admin_enqueue_scripts', array (&$this, 'initCodeMirror'));
        add_action('admin_menu', array (&$this, 'adminPanelsAndMetaBoxes'));

        // Frontend Hooks
        add_action('wp_head', array (&$this, 'frontendHeader'));
        add_action('wp_head', array (&$this, 'loadLanguageFiles'));
        add_action('wp_footer', array (&$this, 'frontendFooter'), 20);
        if ($this->body_open_supported) {
            add_action('wp_body_open', array (&$this, 'frontendBody'), 1);
        }
    }

    /**
     * Register Settings
     */
    function registerSettings()
    {
        register_setting($this->plugin->name, 'ihaf_insert_header', 'trim');
        register_setting($this->plugin->name, 'ihaf_insert_footer', 'trim');
        register_setting($this->plugin->name, 'ihaf_insert_body', 'trim');

        if (is_multisite() && get_current_blog_id() === 1) {
            add_site_option($this->plugin->name, 'ihaf_insert_multisite_body', 'trim');
            add_site_option($this->plugin->name, 'ihaf_insert_multisite_footer', 'trim');
            add_site_option($this->plugin->name, 'ihaf_insert_multisite_header', 'trim');
        }
    }

    /**
     * Register the plugin settings panel
     */
    function adminPanelsAndMetaBoxes()
    {
        add_submenu_page('options-general.php', $this->plugin->displayName, $this->plugin->displayName, 'manage_options', $this->plugin->name, array (&$this, 'adminPanel'));
    }

    /**
     * Output the Administration Panel
     * Save POSTed data from the Administration Panel into a WordPress option
     */
    function adminPanel()
    {
        // only admin user can access this page
        if (!current_user_can('administrator')) {
            echo '<p>' . __('Sorry, you are not allowed to access this page.', 'insert-headers-and-footers') . '</p>';
            return;
        }

        // Save Settings
        if (isset($_REQUEST['submit'])) {
            // Check nonce
            if (!isset($_REQUEST[$this->plugin->name . '_nonce'])) {
                // Missing nonce
                $this->errorMessage = __('nonce field is missing. Settings NOT saved.', 'insert-headers-and-footers');
            } elseif (!wp_verify_nonce($_REQUEST[$this->plugin->name . '_nonce'], $this->plugin->name)) {
                // Invalid nonce
                $this->errorMessage = __('Invalid nonce specified. Settings NOT saved.', 'insert-headers-and-footers');
            } else {
                // Save
                // $_REQUEST has already been slashed by wp_magic_quotes in wp-settings
                // so do nothing before saving
                update_option('ihaf_insert_header', $_REQUEST['ihaf_insert_header']);
                update_option('ihaf_insert_footer', $_REQUEST['ihaf_insert_footer']);
                update_option('ihaf_insert_body', isset($_REQUEST['ihaf_insert_body']) ? $_REQUEST['ihaf_insert_body'] : '');
                update_option($this->plugin->db_welcome_dismissed_key, 1);

                if (is_multisite() && get_current_blog_id() === 1) {
                    update_site_option('ihaf_insert_multisite_body', isset($_REQUEST['ihaf_insert_multisite_body']) ? $_REQUEST['ihaf_insert_multisite_body'] : '');
                    update_site_option('ihaf_insert_multisite_header', isset($_REQUEST['ihaf_insert_multisite_header']) ? $_REQUEST['ihaf_insert_multisite_header'] : '');
                    update_site_option('ihaf_insert_multisite_footer', isset($_REQUEST['ihaf_insert_multisite_footer']) ? $_REQUEST['ihaf_insert_multisite_footer'] : '');
                }

                $this->message = __('Settings Saved.', 'insert-headers-and-footers');
            }
        }

        // Get latest settings
        $this->settings = array (
            'ihaf_insert_header' => esc_html(wp_unslash(get_option('ihaf_insert_header'))),
            'ihaf_insert_footer' => esc_html(wp_unslash(get_option('ihaf_insert_footer'))),
            'ihaf_insert_body' => esc_html(wp_unslash(get_option('ihaf_insert_body'))),
        );

        if (is_multisite() && get_current_blog_id() === 1) {
            $this->settings['ihaf_insert_multisite_body'] = esc_html(wp_unslash(get_site_option('ihaf_insert_multisite_body')));
            $this->settings['ihaf_insert_multisite_header'] = esc_html(wp_unslash(get_site_option('ihaf_insert_multisite_header')));
            $this->settings['ihaf_insert_multisite_footer'] = esc_html(wp_unslash(get_site_option('ihaf_insert_multisite_footer')));
        }

        // Load Settings Form
        include_once($this->plugin->folder . '/views/settings.php');
    }

    /**
     * Enqueue and initialize CodeMirror for the form fields.
     */
    function initCodeMirror()
    {
        // Make sure that we don't fatal error on WP versions before 4.9.
        if (!function_exists('wp_enqueue_code_editor')) {
            return;
        }

        global $pagenow;

        if (!('options-general.php' === $pagenow && isset($_GET['page']) && 'insert-headers-and-footers' === $_GET['page'])) {
            return;
        }

        // Enqueue code editor and settings for manipulating HTML.
        $settings = wp_enqueue_code_editor(array ('type' => 'text/html'));

        // Bail if user disabled CodeMirror.
        if (false === $settings) {
            return;
        }

        // Custom styles for the form fields.
        $styles = '.CodeMirror{ border: 1px solid #ccd0d4; }';

        wp_add_inline_style('code-editor', $styles);

        wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "ihaf_insert_header", %s ); } );', wp_json_encode($settings)));
        wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "ihaf_insert_body", %s ); } );', wp_json_encode($settings)));
        wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "ihaf_insert_footer", %s ); } );', wp_json_encode($settings)));

        if (is_multisite() && get_current_blog_id() === 1) {
            wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "ihaf_insert_multisite_header", %s ); } );', wp_json_encode($settings)));
            wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "ihaf_insert_multisite_body", %s ); } );', wp_json_encode($settings)));
            wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "ihaf_insert_multisite_footer", %s ); } );', wp_json_encode($settings)));
        }
    }

    /**
     * Loads plugin textdomain
     */
    function loadLanguageFiles()
    {
        load_plugin_textdomain('insert-headers-and-footers', false, get_template_directory_uri() . '/languages');
    }

    /**
     * Outputs script / CSS to the frontend header
     */
    function frontendHeader()
    {
        $this->output('ihaf_insert_header');

        if (is_multisite()) {
            $this->output('ihaf_insert_multisite_header');
        }
    }

    /**
     * Outputs script / CSS to the frontend footer
     */
    function frontendFooter()
    {
        $this->output('ihaf_insert_footer');

        if (is_multisite()) {
            $this->output('ihaf_insert_multisite_footer');
        }
    }

    /**
     * Outputs script / CSS to the frontend below opening body
     */
    function frontendBody()
    {
        $this->output('ihaf_insert_body');

        if (is_multisite()) {
            $this->output('ihaf_insert_multisite_body');
        }
    }

    /**
     * Outputs the given setting, if conditions are met
     *
     * @param string $setting Setting Name
     * @return output
     */
    function output($setting)
    {
        // Ignore admin, feed, robots or trackbacks
        if (is_admin() || is_feed() || is_robots() || is_trackback()) {
            return;
        }

        // provide the opportunity to Ignore IHAF - both headers and footers via filters
        if (apply_filters('disable_ihaf', false)) {
            return;
        }

        // provide the opportunity to Ignore IHAF - footer only via filters
        if ('ihaf_insert_footer' === $setting && apply_filters('disable_ihaf_footer', false)) {
            return;
        }

        // provide the opportunity to Ignore IHAF - header only via filters
        if ('ihaf_insert_header' === $setting && apply_filters('disable_ihaf_header', false)) {
            return;
        }

        // provide the opportunity to Ignore IHAF - below opening body only via filters
        if ('ihaf_insert_body' === $setting && apply_filters('disable_ihaf_body', false)) {
            return;
        }

        /**
         * Check if multisite or singlesite
         */
        if (is_multisite()) {
            $meta = get_site_option($setting);
            if (empty($meta)) {
                $meta = get_option($setting);
                if (empty($meta)) {
                    return;
                }
                if (trim($meta) === '') {
                    return;
                }
            }

        } else {
            // Get meta
            $meta = get_option($setting);
            if (empty($meta)) {
                return;
            }
            if (trim($meta) === '') {
                return;
            }
        }


        // Output
        echo wp_unslash($meta);
    }
}

new Growtype_Insert_Headers_And_Footers();
