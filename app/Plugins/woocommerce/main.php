<?php

/**
 * Admin
 */
include('admin/menu/features.php');
include('admin/menu/orders.php');
include('admin/list/columns.php');
include('admin/product/data-attributes.php');
include('admin/product/data-general.php');
include('admin/product/data-advanced.php');
include('admin/product/data-inventory.php');
include('admin/product/data-shipping.php');
include('admin/product/description.php');

include('scripts/scripts.php');

include('emails/preview.php');

include('payments/gateways.php');

include('orders/orders.php');

/**
 * Product single
 */
include('components/message.php');
include('components/product-single-meta.php');
include('components/product-single-intro.php');
include('components/product-single-tabs.php');
include('components/product-single-description.php');
include('components/product-single-excerpt.php');
include('components/product-single-details.php');
include('components/product-single-gallery.php');
include('components/product-single-related-products.php');
include('components/product-single-button.php');
include('components/product-single-reviews.php');
include('components/auction/status.php');

/**
 * Product loop
 */
include('components/product-loop-thumbnail.php');
include('components/product-loop-button.php');
include('components/product-loop-rating.php');

include('components/product-price.php');

/**
 * Product cart
 */
include('cart/main.php');

/**
 * Widgets
 */
include('widgets/widgets.php');

/**
 * Pages
 */
include('pages/wishlist.php');
include('pages/product.php');
include('pages/login.php');
include('pages/catalog.php');
include('pages/checkout.php');
include('pages/cart.php');
include('pages/account/account.php');

/**
 * Blocks
 */
include('blocks/product-grid-item.php');

/**
 * Shortcodes
 */
include('shortcodes/product.php');
