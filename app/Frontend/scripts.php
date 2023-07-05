<?php

/**
 * Theme assets
 */

use function App\config;

add_action('wp_enqueue_scripts', function () {
    if (!is_admin()) {
        /**
         * Fancybox
         */
        wp_enqueue_script('jquery-fancybox-script', growtype_get_parent_theme_public_path() . '/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.js', ['jquery'], null, true);
        wp_enqueue_style('jquery-fancybox-style', growtype_get_parent_theme_public_path() . '/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.css');

        /**
         * Chosen css
         */
        wp_enqueue_script('chosen-script', growtype_get_parent_theme_public_path() . '/vendor/chosen-js/chosen.jquery.min.js', ['jquery'], null, true);
        wp_enqueue_style('chosen-style', growtype_get_parent_theme_public_path() . '/vendor/chosen-js/chosen.min.css', []);

        /**
         * Slick-carousel
         */
        wp_enqueue_script('slick.min.js', growtype_get_parent_theme_public_path() . '/vendor/slick-carousel/slick/slick.min.js', ['jquery'], null, true);
        wp_enqueue_style('slick.css', growtype_get_parent_theme_public_path() . '/vendor/slick-carousel/slick/slick.css');
        wp_enqueue_style('slick-theme.css', growtype_get_parent_theme_public_path() . '/vendor/slick-carousel/slick/slick-theme.css');

        /**
         * Gutenberg scripts
         */
        if (gutenberg_block_editor_is_active()) {
            wp_enqueue_style('growtype-frontend-block-editor-style', growtype_get_parent_theme_public_path() . '/styles/frontend-block-editor.css', [], config('theme.version'));
            wp_enqueue_script('growtype-frontend-block-editor-script', growtype_get_parent_theme_public_path() . '/scripts/frontend-block-editor.js', ['jquery'], config('theme.version'), true);
        }

        /**
         * Main Theme Scripts
         */
        wp_enqueue_style('growtype-app-style', growtype_get_parent_theme_public_path() . '/styles/app.css', [], config('theme.version'));
        wp_enqueue_script('growtype-app-script', growtype_get_parent_theme_public_path() . '/scripts/app.js', ['jquery'], config('theme.version'), true);

        /**
         * Cookie
         */
        wp_enqueue_script('cookie-script', growtype_get_parent_theme_public_path() . '/scripts/cookie.js', ['jquery'], config('theme.version'), true);

        /**
         * Flexmenu
         */
        wp_enqueue_script('flexmenu-script', growtype_get_parent_theme_public_path() . '/scripts/plugins/flexmenu/flexmenu.js', ['jquery'], config('theme.version'), true);

        /**
         * Resize
         */
        wp_enqueue_script('resize-script', growtype_get_parent_theme_public_path() . '/scripts/plugins/resize/resize-sensor.js', ['jquery'], config('theme.version'), true);

        /**
         * Font awesome
         */
        wp_enqueue_style('growtype-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', [], config('theme.version'));

        /**
         * Child Theme Scripts
         */
        if (is_child_theme()) {
            wp_enqueue_style('growtype-app-child-style', growtype_get_child_theme_public_path() . '/styles/app-child.css', [], config('wp.env') !== 'production' ? time() : config('theme.version'), 'all');

            wp_enqueue_script('growtype-app-child-script', growtype_get_child_theme_public_path() . '/scripts/app-child.js', false, config('wp.env') !== 'production' ? time() : config('theme.version'), true);

            wp_localize_script('growtype-app-child-script', 'ajax_object', array (
                    'ajaxurl' => admin_url('admin-ajax.php')
                )
            );
        }

        /**
         * Comments
         */
        if (is_single() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
}, 100);

/**
 * Growtype params
 */
add_action('wp_footer', function () { ?>
    <script type="text/javascript">
        let growtype_params = {
            page_nr: <?php echo get_query_var('paged') ?>,
            text_more: '<?php echo __('More', 'growtype') ?>',
            text_read_close: '<?php echo __('Read close', 'growtype') ?>',
            text_read_more: '<?php echo __('Read more', 'growtype') ?>',
            text_attach_media: '<?php echo __('Attach media', 'growtype') ?>',
        }
    </script>
<?php });

/**
 *
 */
add_action('wp_default_scripts', 'growtype_dequeue_wp_default_scripts');
function growtype_dequeue_wp_default_scripts($scripts)
{
    if (!is_admin() && !empty($scripts->registered['jquery'])) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff($jquery_dependencies, array ('jquery-migrate'));
    }
}
