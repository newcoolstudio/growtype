<?php
include('includes/data.php');
include('includes/translations.php');
include('includes/custom-controls.php');
include('includes/styles-applied.php');

include('sections/colors.php');

include('includes/scripts.php');

include('sections/header.php');

if (class_exists('woocommerce')) {
    include('sections/woocommerce.php');
}

if (class_exists('qTranslateXWidget')) {
    include('sections/language.php');
}

include('sections/footer.php');
include('sections/social.php');
include('sections/general.php');
include('sections/gdpr.php');

include('sections/fonts.php');
include('sections/buttons.php');
include('sections/menu.php');

include('sections/sidebar.php');
include('sections/panel.php');
include('sections/accesses.php');
include('sections/post.php');
include('sections/profile.php');
