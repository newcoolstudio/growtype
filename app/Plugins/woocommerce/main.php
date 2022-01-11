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
include('admin/product/description.php');

include('scripts/scripts.php');

include('emails/preview.php');

include('payments/gateways.php');

include('orders/orders.php');

include('components/messages.php');
include('components/cart.php');
include('components/checkout.php');
include('components/product-loop-thumbnail.php');
include('components/product-loop-link.php');
include('components/reviews.php');
include('components/products-ordering.php');
include('components/product.php');
include('components/coupon.php');
include('components/buttons.php');
include('components/product-single-tabs.php');
include('components/product-single-description.php');
include('components/product-single-excerpt.php');
include('components/product-single-details.php');
include('components/product-single-gallery.php');
include('components/product-preview.php');
include('components/product-single-related-products.php');
include('components/product-single-meta.php');

include('widgets/widgets.php');

include('pages/wishlist.php');
include('pages/product-single.php');
include('pages/login.php');
include('pages/archive.php');
include('pages/checkout.php');
include('pages/account/account.php');

/**
 * Blocks
 */
include('blocks/product-grid-item.php');

/**
 * Shortcodes
 */
include('shortcodes/product.php');
