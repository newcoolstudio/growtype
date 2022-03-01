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
