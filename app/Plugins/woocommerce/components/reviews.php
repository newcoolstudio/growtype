<?php

/**
 * Reviews section added to single product page
 */

add_filter('woocommerce_after_single_product', 'add_reviews_section', 10);
function add_reviews_section()
{
    comments_template('woocommerce/single-product-reviews');
}
