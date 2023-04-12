<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus(array (
        'header' => esc_html__('Header', 'growtype'),
        'footer' => esc_html__('Footer', 'growtype'),
        'mobile' => esc_html__('Mobile', 'growtype'),
        'header-side' => esc_html__('Header - Side', 'growtype'),
        'header-login' => esc_html__('Header - Login', 'growtype'),
        'user-profile' => esc_html__('User Profile', 'growtype'),
        'panel' => esc_html__('Panel', 'growtype'),
    ));

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    add_image_size('icon', 200, 200, false);
    add_image_size('thumbnail', 400, 400, false);
    add_image_size('medium', 700, 600, false);
    add_image_size('large', 1800, 1000, false);

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
        'navigation-widgets'
    ]);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Load parent theme languages
     */
    load_theme_textdomain('growtype', growtype_get_parent_theme_resource_path() . '/languages');

    /**
     * Load child theme languages
     */
    load_child_theme_textdomain('growtype-child', growtype_get_child_theme_resource_path() . '/languages');

    /**
     * Gutenberg
     */
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_theme_support('dark-editor-style');
    add_theme_support('custom-spacing');

    /**
     * Responsive embeds
     */
    add_theme_support('responsive-embeds');

    /**
     * post-formats
     */
    add_theme_support('post-formats', array ('aside', 'image', 'video', 'quote', 'link', 'status'));

    /**
     * automatic-feed-links
     */
    add_theme_support('automatic-feed-links');
}, 20);

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?php echo " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });

    /**
     * Create svg() Blade directive
     */
    sage('blade')->compiler()->directive('svg', function ($arguments) {
        $childTheme = $path = $class = '';
        list($path, $class, $childTheme) = array_pad(explode(',', trim($arguments, "() ")), 2, '');
        $path = trim($path, "' ");
        $class = trim($class, "' ");
        $childTheme = trim($childTheme, "' ");
        $filePath = $childTheme !== 'true' ? dirname(get_template_directory_uri()) . '/public/' . $path : dirname(get_stylesheet_directory_uri()) . '/public/' . $path;
        $svg = new \DOMDocument();
        $svg->load($filePath);
        if (!empty($svg->documentElement)) {
            $svg->documentElement->setAttribute("class", $class);
            $output = $svg->saveXML($svg->documentElement);
        } else {
            $output = file_get_contents($filePath . $path);
        }
        return $output;
    });
});

/**
 * Load custom urls
 */
add_filter('generate_rewrite_rules', function ($wp_rewrite) {
    $wp_rewrite->rules = array_merge(
        ['^documentation/examples/([^/]*)/?/([^/]*)/?' => 'index.php?example_category=$matches[1]&example_type=$matches[2]'],
        $wp_rewrite->rules
    );
});

add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'example_category';
    $query_vars[] = 'example_type';
    return $query_vars;
});

/**
 * Template redirect
 */
add_action('template_redirect', function () {
    /**
     * Check if user should be redirected to specific url.
     */
    growtype_custom_page_redirect();

    /**
     * Template redirect
     */
    $example_category = get_query_var('example_category');
    $example_type = get_query_var('example_type');
    if ($example_category && $example_type) {
        $url_path = trim(parse_url(add_query_arg(array ()), PHP_URL_PATH), '/');
        try {
            echo sage('blade')->render($url_path, []);
        } catch (\Exception $ex) {
            wp_redirect(home_url());
        }
        exit;
    }
});
