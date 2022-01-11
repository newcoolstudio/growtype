<?php

/**
 * Display 4 product rows
 */
if (!function_exists('loop_columns') && isset($_POST['action']) && $_POST['action'] === 'fetch_user_data') {
    add_filter('loop_shop_columns', 'loop_columns', 999);
    function loop_columns()
    {
        return 4;
    }
}

/**
 * Enqueue scripts
 */
add_action('wp_enqueue_scripts', 'wc_wishlist_scripts');
function wc_wishlist_scripts()
{
    wp_enqueue_script('wc-wishlist', get_template_directory_uri() . '/../public/scripts/plugins/woocommerce/wc-wishlist.js', '', '', true);
    wp_localize_script(
        'wc-wishlist',
        'woocommerce_params_wishlist',
        array (
            'ajax_post' => admin_url('admin-post.php'),
            'rest_url' => rest_url('wp/v2/product'),
            'shop_name' => sanitize_title_with_dashes(sanitize_title_with_dashes(get_bloginfo('name'))),
            'in_wishlist_text' => esc_html__("Already in wishlist", "growtype"),
            'remove_from_wishlist_text' => esc_html__("Remove from wishlist", "growtype"),
            'error_text' => esc_html__("Something went wrong, could not add to wishlist", "growtype"),
            'no_wishlist_text' => esc_html__("No wishlist found", "growtype"),
        )
    );
}

/**
 * Get current user data
 */
add_action('wp_ajax_fetch_user_data', 'fetch_user_data');
add_action('wp_ajax_nopriv_fetch_user_data', 'fetch_user_data');
function fetch_user_data()
{
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $current_user_wishlist_ids = get_user_meta($current_user->ID, 'wishlist_ids', true);
        $current_user_wishlist_ids = explode(',', $current_user_wishlist_ids);

        /**
         * Compare with existing products, if all wishlist ids exist
         */
        $all_ids = get_posts(array (
            'post_type' => 'product',
            'numberposts' => -1,
            'post_status' => 'publish',
            'fields' => 'ids',
        ));

        if ($all_ids !== $current_user_wishlist_ids) {
            $filtered_data = [];
            foreach ($current_user_wishlist_ids as $single_wishlist_id) {
                if (in_array($single_wishlist_id, $all_ids)) {
                    array_push($filtered_data, $single_wishlist_id);
                }
            }

            $current_user_wishlist_ids = $filtered_data;
        }

    } else {
        $current_user_wishlist_ids = isset($_POST['wishlist_ids']) && !empty($_POST['wishlist_ids']) ? $_POST['wishlist_ids'] : [];
    }

    $wishList = get_wishlist_html($current_user_wishlist_ids);

    echo json_encode(
        [
            'user_id' => $current_user->ID,
            'wishlist' => $wishList,
            'wishlist_ids' => $current_user_wishlist_ids
        ]
    );

    die();
}

/**
 * Wishlist html
 */

function get_wishlist_html($wishlist_ids)
{
    if (empty($wishlist_ids)) {
        $content = ob_start();
        do_action('woocommerce_no_products_found');
        $content = ob_get_clean();
    } else {
        $products = new stdClass();
        $products->products = wc_get_products(array (
            'status' => 'publish',
            'limit' => -1,
            'paginate' => false,
            'return' => 'ids',
            'include' => $wishlist_ids
        ));

        $content = ob_start();

        if (isset($products->products) && !empty($products->products)) {
            do_action('woocommerce_before_shop_loop');
            woocommerce_product_loop_start();
            foreach ($products->products as $product) {
                $post_object = get_post($product);
                $product = wc_get_product($product);
                setup_postdata($GLOBALS['post'] =& $post_object);
                wc_get_template_part('content', 'product');
            }
            wp_reset_postdata();
            woocommerce_product_loop_end();
            do_action('woocommerce_after_shop_loop');
        } else {
            do_action('woocommerce_no_products_found');
        }

        $content = ob_get_clean();
    }

    return $content;
}

function update_wishlist_ajax()
{
    if (isset($_POST["user_id"]) && !empty($_POST["user_id"])) {
        $user_id = $_POST["user_id"];
        $user_obj = get_user_by('id', $user_id);
        if (!is_wp_error($user_obj) && is_object($user_obj)) {
            update_user_meta($user_id, 'wishlist_ids', $_POST["wishlist_ids"]);
        }
    }
    die();
}

add_action('admin_post_nopriv_user_wishlist_update', 'update_wishlist_ajax');
add_action('admin_post_user_wishlist_update', 'update_wishlist_ajax');

/**
 * // Wishlist table shortcode
 */

add_shortcode('wishlist', 'wishlist');
function wishlist($atts, $content = null)
{
    extract(shortcode_atts(array (), $atts));

    return '<div class="wishlist-preview"></div>';

}
