<?php
include('includes/data.php');
include('includes/custom-controls.php');
include('includes/translations.php');
include('includes/scripts.php');
include('includes/styles-applied.php');

include('sections/header.php');
include('sections/search.php');

if (class_exists('woocommerce')) {
    include('sections/woocommerce.php');
}

if (class_exists('qTranslateXWidget')) {
    include('sections/language.php');
}

include('sections/footer.php');
include('sections/social.php');
include('sections/general.php');
include('sections/colors.php');
include('sections/fonts.php');
include('sections/buttons.php');
include('sections/site-identity.php');
include('sections/menu.php');
include('sections/sidebar.php');
include('sections/panel.php');
include('sections/accesses.php');
include('sections/post.php');
include('sections/profile.php');
