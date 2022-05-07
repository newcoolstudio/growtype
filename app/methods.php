<?php

/**
 * Posts methods
 */
if (!class_exists('Growtype_Post')) {
    include('Methods/class-growtype-post.php');
    new Growtype_Post();
}

/**
 * Page
 */
include('Methods/class-growtype-language.php');
include('Methods/class-growtype-search.php');
include('Methods/class-growtype-user.php');
include('Methods/class-growtype-user-account.php');
include('Methods/class-growtype-social.php');

/**
 * Shop methods
 */
if (!class_exists('Growtype_Shop')) {
    include('Methods/class-growtype-shop.php');
}

/**
 * Product methods
 */
if (!class_exists('Growtype_Product')) {
    include('Methods/class-growtype-product.php');
}

/**
 * Header methods
 */
if (!class_exists('Growtype_Header')) {
    include('Methods/class-growtype-header.php');
}
