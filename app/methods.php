<?php

/**
 * Page
 */
include('Methods/class-growtype-post.php');
include('Methods/class-growtype-language.php');
include('Methods/class-growtype-search.php');

/**
 * Auction
 */
if (!class_exists('Growtype_Auction')) {
    include('Methods/class-growtype-auction.php');
}

/**
 * Product
 */
if (!class_exists('Growtype_Product')) {
    include('Methods/class-growtype-product.php');
}
