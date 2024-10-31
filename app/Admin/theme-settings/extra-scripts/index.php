<?php

/**
 * Insert Headers and Footers Classes
 */
class Growtype_Admin_Theme_Settings_Extra_Scripts
{
    const PLUGIN_SLUG = 'growtype-extra-scripts';

    private $body_open_supported;

    private $plugin;

    private $message;

    private $settings;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plugin = new stdClass;
        $this->plugin->slug = self::PLUGIN_SLUG;
        $this->plugin->displayName = 'Extra Scripts';
        $this->plugin->page = 'admin.php';
        $this->plugin->version = '1.0';
        $this->plugin->folder = plugin_dir_path(__FILE__);
        $this->plugin->url = plugin_dir_url(__FILE__);
        $this->plugin->db_welcome_dismissed_key = $this->plugin->slug . '_welcome_dismissed_key';

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
        register_setting($this->plugin->slug, 'growtype_insert_header', 'trim');
        register_setting($this->plugin->slug, 'growtype_insert_footer', 'trim');
        register_setting($this->plugin->slug, 'growtype_insert_body', 'trim');

        if (is_multisite() && get_current_blog_id() === 1) {
            add_site_option($this->plugin->slug, 'growtype_insert_multisite_body', 'trim');
            add_site_option($this->plugin->slug, 'growtype_insert_multisite_footer', 'trim');
            add_site_option($this->plugin->slug, 'growtype_insert_multisite_header', 'trim');
        }
    }

    /**
     * Register the plugin settings panel
     */
    function adminPanelsAndMetaBoxes()
    {
        add_submenu_page(
            'growtype-theme-settings',
            $this->plugin->displayName,
            $this->plugin->displayName,
            'manage_options',
            $this->plugin->slug,
            array (&$this, 'adminPanel')
        );
    }

    /**
     * Output the Administration Panel
     * Save POSTed data from the Administration Panel into a WordPress option
     */
    function adminPanel()
    {
        // only admin user can access this page
        if (!current_user_can('administrator')) {
            echo '<p>' . __('Sorry, you are not allowed to access this page.', $this->plugin->slug) . '</p>';
            return;
        }

        // Save Settings
        if (isset($_REQUEST['submit'])) {
            // Check nonce
            if (!isset($_REQUEST[$this->plugin->slug . '_nonce'])) {
                // Missing nonce
                $this->errorMessage = __('nonce field is missing. Settings NOT saved.', $this->plugin->slug);
            } elseif (!wp_verify_nonce($_REQUEST[$this->plugin->slug . '_nonce'], $this->plugin->slug)) {
                // Invalid nonce
                $this->errorMessage = __('Invalid nonce specified. Settings NOT saved.', $this->plugin->slug);
            } else {
                // Save
                // $_REQUEST has already been slashed by wp_magic_quotes in wp-settings
                // so do nothing before saving
                update_option('growtype_insert_header', $_REQUEST['growtype_insert_header']);
                update_option('growtype_insert_footer', $_REQUEST['growtype_insert_footer']);
                update_option('growtype_insert_body', isset($_REQUEST['growtype_insert_body']) ? $_REQUEST['growtype_insert_body'] : '');
                update_option($this->plugin->db_welcome_dismissed_key, 1);

                if (is_multisite() && get_current_blog_id() === 1) {
                    update_site_option('growtype_insert_multisite_body', isset($_REQUEST['growtype_insert_multisite_body']) ? $_REQUEST['growtype_insert_multisite_body'] : '');
                    update_site_option('growtype_insert_multisite_header', isset($_REQUEST['growtype_insert_multisite_header']) ? $_REQUEST['growtype_insert_multisite_header'] : '');
                    update_site_option('growtype_insert_multisite_footer', isset($_REQUEST['growtype_insert_multisite_footer']) ? $_REQUEST['growtype_insert_multisite_footer'] : '');
                }

                $this->message = __('Settings Saved.', $this->plugin->slug);
            }
        }

        // Get latest settings
        $this->settings = array (
            'growtype_insert_header' => esc_html(wp_unslash(get_option('growtype_insert_header'))),
            'growtype_insert_footer' => esc_html(wp_unslash(get_option('growtype_insert_footer'))),
            'growtype_insert_body' => esc_html(wp_unslash(get_option('growtype_insert_body'))),
        );

        if (is_multisite() && get_current_blog_id() === 1) {
            $this->settings['growtype_insert_multisite_body'] = esc_html(wp_unslash(get_site_option('growtype_insert_multisite_body')));
            $this->settings['growtype_insert_multisite_header'] = esc_html(wp_unslash(get_site_option('growtype_insert_multisite_header')));
            $this->settings['growtype_insert_multisite_footer'] = esc_html(wp_unslash(get_site_option('growtype_insert_multisite_footer')));
        }

        // Load Settings Form
        include_once($this->plugin->folder . 'includes/views/settings.php');
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

        if (!($this->plugin->page === $pagenow && isset($_GET['page']) && $this->plugin->slug === $_GET['page'])) {
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

        wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "growtype_insert_header", %s ); } );', wp_json_encode($settings)));
        wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "growtype_insert_body", %s ); } );', wp_json_encode($settings)));
        wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "growtype_insert_footer", %s ); } );', wp_json_encode($settings)));

        if (is_multisite() && get_current_blog_id() === 1) {
            wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "growtype_insert_multisite_header", %s ); } );', wp_json_encode($settings)));
            wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "growtype_insert_multisite_body", %s ); } );', wp_json_encode($settings)));
            wp_add_inline_script('code-editor', sprintf('jQuery( function() { wp.codeEditor.initialize( "growtype_insert_multisite_footer", %s ); } );', wp_json_encode($settings)));
        }
    }

    /**
     * Loads plugin textdomain
     */
    function loadLanguageFiles()
    {
        load_plugin_textdomain($this->plugin->slug, false, get_template_directory_uri() . '/languages');
    }

    /**
     * Outputs script / CSS to the frontend header
     */
    function frontendHeader()
    {
        $this->output('growtype_insert_header');

        if (is_multisite()) {
            $this->output('growtype_insert_multisite_header');
        }
    }

    /**
     * Outputs script / CSS to the frontend footer
     */
    function frontendFooter()
    {
        $this->output('growtype_insert_footer');

        if (is_multisite()) {
            $this->output('growtype_insert_multisite_footer');
        }
    }

    /**
     * Outputs script / CSS to the frontend below opening body
     */
    function frontendBody()
    {
        $this->output('growtype_insert_body');

        if (is_multisite()) {
            $this->output('growtype_insert_multisite_body');
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

        if (apply_filters('disable_growtype_extra_scripts', false)) {
            return;
        }

        if ('growtype_insert_footer' === $setting && apply_filters('disable_growtype_extra_scripts_footer', false)) {
            return;
        }

        if ('growtype_insert_header' === $setting && apply_filters('disable_growtype_extra_scripts_header', false)) {
            return;
        }

        if ('growtype_insert_body' === $setting && apply_filters('disable_growtype_extra_scripts_body', false)) {
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
