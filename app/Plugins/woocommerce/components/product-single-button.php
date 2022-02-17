<?php

/**
 * Add to cart button text
 */
add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_product_add_to_cart_text_custom');
add_filter('woocommerce_product_add_to_cart_text', 'woocommerce_product_add_to_cart_text_custom');
function woocommerce_product_add_to_cart_text_custom()
{
    global $product;

    $add_to_cart_button_custom_text = Growtype_Product::get_add_to_cart_btn_text($product);

    if (empty($product)) {
        return $add_to_cart_button_custom_text;
    }

    $product_type = $product->get_type();

    switch ($product_type) {
        case 'external':
            return $add_to_cart_button_custom_text;
            break;
        case 'grouped':
            return __('Select', 'growtype');
            break;
        case 'simple':
            return $add_to_cart_button_custom_text;
            break;
        case 'variable':
            return $add_to_cart_button_custom_text;
            break;
        default:
            return $add_to_cart_button_custom_text;
    }
}

/**
 * Download button for downloadable products
 */
add_action('woocommerce_single_product_summary', 'single_product_download_button');
function single_product_download_button()
{
    global $product;

    $regular_price = $product->get_regular_price();

    if (empty($regular_price) && $product->get_downloadable()) {
        $downloads = $product->get_downloads();

        foreach ($downloads as $download) {
            $download_data = $download->get_data();
            ?>
            <div class="download-action">
                <?php
                if (count($downloads) > 1) { ?>
                    <p><?php echo $download_data['name'] ?></p>
                <?php } ?>
                <a href="<?php echo $download_data['file'] ?>" class="btn btn-primary btn-download" download="<?php echo $download_data['name'] ?>">
                    <?php esc_html_e('Download', 'growtype') ?>
                </a>
                <a href="<?php echo $download_data['file'] ?>" class="btn btn-secondary btn-preview fancybox" data-fancybox-type="iframe">
                    <?php esc_html_e('Preview', 'growtype') ?>
                </a>
            </div>
        <?php } ?>
    <?php }
}

/**
 * Add to cart link adjusting if individual product is in the cart
 */
add_filter('woocommerce_product_add_to_cart_url', 'adjust_add_to_cart_button_link', 10, 2);
function adjust_add_to_cart_button_link($add_to_cart_url, $product)
{
    if (empty(WC()->cart)) {
        return null;
    }

    $product_in_cart = product_is_in_cart($product);

    if ($product->is_purchasable()
        && $product_in_cart
        && $product->is_in_stock()) {
        $add_to_cart_url = wc_get_checkout_url();
    }

    /**
     * Permalink update
     */
    if ($add_to_cart_url === get_permalink($product->get_id())) {
        $add_to_cart_url = Growtype_Product::permalink($product->get_id());
    }

    return $add_to_cart_url;
}
