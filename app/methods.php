<?php

/**
 * Page
 */
include('Methods/class-growtype-post.php');
include('Methods/class-growtype-language.php');
include('Methods/class-growtype-search.php');
include('Methods/class-growtype-user.php');
include('Methods/class-growtype-user-account.php');

/**
 * Auction
 */
if (!class_exists('Growtype_Auction')) {
    include('Methods/class-growtype-auction.php');
}

/**
 * Shop
 */
if (!class_exists('Growtype_Shop')) {
    include('Methods/class-growtype-shop.php');
}

/**
 * Product
 */
if (!class_exists('Growtype_Product')) {
    include('Methods/class-growtype-product.php');
}

/**
 * Header
 */
if (!class_exists('Growtype_Header')) {
    include('Methods/class-growtype-header.php');
}
