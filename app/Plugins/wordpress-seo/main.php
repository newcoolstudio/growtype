<?php

/**
 * Hide promo
 */
add_action('admin_head', 'growtype_wpseo_admin_head');
function growtype_wpseo_admin_head()
{
    echo '<style>.wp-admin .wrap .yoast-notification.notice.is-dismissible {display: none!important;}</style>';
}
