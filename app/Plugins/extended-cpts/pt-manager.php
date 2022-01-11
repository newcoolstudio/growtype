<?php

/**
 * Custom post types
 * project, testimonial, member, office, service, activity
 */

if (get_option('cpt_1_enabled')) {
    include(dirname(__FILE__) . '/../../Plugins/extended-cpts/pt-tx/project.php');
}

if (get_option('cpt_2_enabled')) {
    include(dirname(__FILE__) . '/../../Plugins/extended-cpts/pt-tx/testimonial.php');
}

if (get_option('cpt_3_enabled')) {
    include(dirname(__FILE__) . '/../../Plugins/extended-cpts/pt-tx/member.php');
}

if (get_option('cpt_4_enabled')) {
    include(dirname(__FILE__) . '/../../Plugins/extended-cpts/pt-tx/office.php');
}

if (get_option('cpt_5_enabled')) {
    include(dirname(__FILE__) . '/../../Plugins/extended-cpts/pt-tx/service.php');
}

include(dirname(__FILE__) . '/../../Plugins/extended-cpts/pt-tx/partials/project.php');
include(dirname(__FILE__) . '/../../Plugins/extended-cpts/pt-tx/partials/activity.php');

