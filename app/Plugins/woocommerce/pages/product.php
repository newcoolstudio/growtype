<?php

/**
 * Related products amount
 */
add_filter('woocommerce_output_related_products_args', 'growtype_woocommerce_output_related_products_args', 20);
function growtype_woocommerce_output_related_products_args($args)
{
    $products_amount = 4;
    if (!empty(get_theme_mod('woocommerce_product_page_related_products_amount'))) {
        $products_amount = get_theme_mod('woocommerce_product_page_related_products_amount');
    }

    $args['posts_per_page'] = $products_amount;
    $args['columns'] = $products_amount;
    return $args;
}

/**
 * Wishlist button
 */
add_filter('woocommerce_after_add_to_cart_button', 'wc_add_wishlist_to_product_page', 5);
function wc_add_wishlist_to_product_page()
{
    $current_user = wp_get_current_user();
    $current_user_wishlist_ids = get_user_meta($current_user->ID, 'wishlist_ids', true);
    $current_user_wishlist_ids = explode(',', $current_user_wishlist_ids);
    $productInWishlist = in_array(get_the_ID(), $current_user_wishlist_ids);
    ?>
    <?php
    if (wishlist_page_icon()) { ?>
        <div class="wishlist-toggle <?php echo $productInWishlist ? 'is-active' : '' ?>" data-product="<?php echo get_the_ID() ?>" title="<?php echo esc_attr__(" Add to Wishlist", "text-domain") ?>">
            <span class="e-text"><?php echo esc_attr__("Add to Wishlist", "text-domain") ?></span>
        </div>
    <?php } ?>
    <?php
}

/**
 * Remove the breadcrumbs
 */
add_action('init', 'wc_remove_breadcrumbs');
function wc_remove_breadcrumbs()
{
    if (!get_theme_mod('woocommerce_product_page_breadcrumb_status')) {
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    }
}

/**
 * Breadcrumb home url
 */
add_filter('woocommerce_breadcrumb_home_url', 'wc_breadrumb_home_url');
function wc_breadrumb_home_url()
{
    return get_permalink(wc_get_page_id('shop'));
}

/**
 * Setup breadcrumb
 */
add_filter('woocommerce_breadcrumb_defaults', 'wc_breadcrumbs_setup');
function wc_breadcrumbs_setup($defaults)
{
    $shop_page = get_post(wc_get_page_id('shop'));

    return array (
        'delimiter' => ' &#47; ',
        'wrap_before' => '<div class="woocommerce-breadcrumb ' . (!is_product() ? 'd-none' : '') . '" itemprop="breadcrumb"><div class="woocommerce-breadcrumb-inner container">',
        'wrap_after' => '</div></div>',
        'before' => '',
        'after' => '',
        'home' => $shop_page->post_title,
    );
}

/**
 * Alter breadcrumb
 */
add_filter('woocommerce_get_breadcrumb', 'wc_breadcrumbs_alter', 10, 2);
function wc_breadcrumbs_alter($crumbs, $breadcrumb)
{
    if (is_product()) {
        array_pop($crumbs);
    }

    return $crumbs;
}

/**
 * Add info below add to form button
 */
add_action('woocommerce_after_add_to_cart_form', 'wc_payment_details');
function wc_payment_details()
{
    echo \App\template('woocommerce.components.product-single-payment-details');
}

/**
 * Add sign after quantity input
 */
add_action('woocommerce_before_quantity_input_field', 'wc_change_quantity_down');
function wc_change_quantity_down()
{
    echo '<div class="btn btn-down">-</div>';
}

/**
 * Add sign after quantity input
 */
add_action('woocommerce_after_quantity_input_field', 'wc_change_quantity_up');
function wc_change_quantity_up()
{
    echo '<div class="btn btn-up">+</div>';
}

/**
 * Customize variation option name. Display out of stock.
 */
add_filter('woocommerce_variation_option_name', 'wc_customize_variation_option_name', 10, 1);
function wc_customize_variation_option_name($term_name)
{
    global $product;

    if (empty($product)) {
        return null;
    }

    $product_variations = $product->get_available_variations();

    foreach ($product_variations as $product_variation) {
        if (isset($product_variation['attributes'])) {
            $key = array_search($term_name, $product_variation['attributes']);

            if ($key !== false && !$product_variation['is_in_stock']) {
                return $term_name . ' - Out of Stock';
            }
        }
    }

    return $term_name;
}
