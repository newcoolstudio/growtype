<?php

/**
 * @param $cart_item
 * @return false|string
 */
function render_current_cart_single_item($cart_item)
{
    if (empty($cart_item)) {
        return '';
    }

    $_product = wc_get_product($cart_item['product_id']);
    $productPriceHtml = WC()->cart->get_product_price($_product);
    $productImage = $_product->get_image();

    if ($_product->is_type('variable')) {
        $productVariation = new WC_Product_Variation($cart_item['variation_id']);
        $productPriceHtml = !empty($productVariation->get_price_html()) ? $productVariation->get_price_html() : $productPriceHtml;
        $productImage = !empty($productVariation->get_image()) ? $productVariation->get_image() : $productImage;
        $product_attributes = $productVariation->get_attributes();
    }

    $product_permalink = esc_url($_product->get_permalink($cart_item));

    ob_start();
    ?>
    <li class="shoppingcart-products-item" data-cart_item_key="<?php echo $cart_item['key'] ?>">
        <a href="#" class="e-remove"
           aria-label="<?php echo __('Remove this item', 'growtype') ?>"
           data-product_id="<?php echo $cart_item['product_id'] ?>"
           data-variation_id="<?php echo $cart_item['variation_id'] ?>"
           data-product_sku="<?php echo $_product->get_sku() ?>"
        ></a>
        <a href="<?php echo esc_url($_product->get_permalink($cart_item)) ?>" class="product-image">
            <?php echo $productImage ?>
        </a>
        <div class="product-details">
            <a href="<?php echo $product_permalink ?>" class="product-name">
                <div class="product-name-title"><?php echo $cart_item['data']->get_title() ?></div>
                <?php if (isset($product_attributes) && !empty($product_attributes)) { ?>
                    <div class="product-name-summary"><?php echo wc_get_formatted_variation($product_attributes, true) ?></div>
                <?php } ?>
            </a>
            <div class="quantity">
                <span class="quantity-amount"><?php echo $cart_item['quantity'] ?></span>
                <span class="e-multiply"> x </span>
                <span class="quantity-price"><?php echo $productPriceHtml ?></span>
            </div>
            <div class="product-changeQuantity"
                 data-product_id="<?php echo $cart_item['product_id'] ?>"
                 data-variation_id="<?php echo $cart_item['variation_id'] ?>"
                 data-product_sku="<?php echo $_product->get_sku() ?>">
                <span class="arrow arrow-left">-</span>
                <span class="amount"><?php echo $cart_item['quantity'] ?></span>
                <span class="arrow arrow-right">+</span>
            </div>
        </div>
    </li>
    <?php

    return ob_get_clean();

}

/**
 * @return false|string
 * Get cart content
 */
function render_current_cart_content()
{
    ob_start();

    ?>

    <?php if (!WC()->cart->is_empty()) { ?>

    <div class="b-shoppingcart-content">

        <ul class="shoppingcart-products">
            <?php
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                echo render_current_cart_single_item($cart_item);
            }
            ?>
        </ul>

    </div>

    <div class="shoppingcart-total">
        <p class="text"><?php _e('Subtotal', 'growtype'); ?></p>
        <div class="e-subtotal_price"><?php echo WC()->cart->get_cart_subtotal(); ?></div>
        <p class="text-extra">Your total cart amount</p>
        <div class="woocommerce-mini-cart__buttons buttons">
            <a href="<?php echo wc_get_checkout_url(); ?>" class="btn btn-primary"><?php echo __('Checkout', 'growtype') ?></a>
            <a href="<?php echo wc_get_cart_url(); ?>" class="btn btn-secondary"><?php echo __('View cart', 'growtype') ?></a>
        </div>
    </div>

<?php } else { ?>
    <div class="col-12 text-center">
        <p class="e-message"><?php _e('No products in the cart.', 'growtype'); ?></p>
        <a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>" class="btn btn-primary"><?php _e('Go to shop', 'growtype'); ?></a>
    </div>
<?php } ?>

    <?php
    $cart = ob_get_clean();
    return $cart;
}

/**
 * @return bool
 */
function cart_page_icon_is_active()
{
    $disabled = get_theme_mod('woocommerce_cart_page_icon_disabled') ?? false;

    return class_exists('WooCommerce') && !$disabled ? true : false;
}

/**
 * @return bool
 */
function cart_is_empty()
{
    return count(WC()->cart->get_cart()) === 0;
}

/**
 * @param $product
 * @return bool
 */
function product_is_in_cart($product)
{
    $product_in_cart = WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product->get_id()));

    return !empty($product_in_cart) ? true : false;
}

/**
 * @return mixed
 * Skip cart page
 */
function skip_cart_page()
{
    return get_theme_mod('woocommerce_skip_cart_page');
}