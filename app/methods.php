<?php

/**
 * Posts methods
 */
if (!class_exists('Growtype_Page')) {
    include_once __DIR__ . '/Methods/class-growtype-page.php';
}

/**
 * Cache
 */
if (!class_exists('Growtype_Cache')) {
    include_once __DIR__ . '/Methods/class-growtype-cache.php';
}

/**
 * User
 */
if (!class_exists('Growtype_User')) {
    include_once __DIR__ . '/Methods/class-growtype-user.php';
}

/**
 * User
 */
if (!class_exists('Growtype_User_Account')) {
    include_once __DIR__ . '/Methods/class-growtype-user-account.php';
}

/**
 * Header methods
 */
if (!class_exists('Growtype_Header')) {
    include_once __DIR__ . '/Methods/class-growtype-header.php';
}

/**
 * Site methods
 */
if (!class_exists('Growtype_Site')) {
    include_once __DIR__ . '/Methods/class-growtype-site.php';
}
/**
 * Session methods
 */
if (!class_exists('Growtype_Session')) {
    include_once __DIR__ . '/Methods/class-growtype-session.php';
}

/**
 * Modal methods
 */
if (!class_exists('Growtype_Modal')) {
    include_once __DIR__ . '/Methods/class-growtype-modal.php';
    new Growtype_Modal();
}
