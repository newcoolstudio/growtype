<?php

/**
 * Posts methods
 */
if (!class_exists('Growtype_Page')) {
    include('Methods/class-growtype-page.php');
}

/**
 * Cache
 */
include('Methods/class-growtype-cache.php');

/**
 * Page
 */
include('Methods/class-growtype-language.php');
include('Methods/class-growtype-user.php');
include('Methods/class-growtype-user-account.php');
include('Methods/class-growtype-social.php');

/**
 * Header methods
 */
if (!class_exists('Growtype_Header')) {
    include('Methods/class-growtype-header.php');
}

/**
 * Site methods
 */
if (!class_exists('Growtype_Site')) {
    include('Methods/class-growtype-site.php');
}
