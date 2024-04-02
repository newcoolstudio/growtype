<?php
/**
 * @param $login_title
 * @return string|string[]
 * Change page title
 */
add_filter('login_title', 'growtype_login_title');
function growtype_login_title($login_title)
{
    return str_replace(array (' &lsaquo;', ' &#8212; WordPress'), array (' &bull;', ''), $login_title);
}

/**
 * @return string
 * Login logo url
 */
add_filter('login_headerurl', 'growtype_login_headerurl');
function growtype_login_headerurl()
{
    return growtype_get_home_url();
}

/**
 *
 */
add_action('login_head', 'growtype_login_head');
function growtype_login_head()
{
    if (!empty(get_theme_mod('body_background_color'))) {
        echo '<style type="text/css">body{background-color:' . get_theme_mod('body_background_color') . ';</style>';
    }
}

/**
 * @return false
 * Scripts
 */
add_action('login_enqueue_scripts', 'growtype_login_enqueue_scripts');
function growtype_login_enqueue_scripts()
{
    if (!isset(growtype_get_login_logo()['url']) || empty(growtype_get_login_logo()['url'])) {
        return false;
    }

    ?>
    <style>
        .login h1 a {
            background-image: url(<?php echo growtype_get_login_logo()['url']?>) !important;
            background-position: center center !important;
            width: 240px !important;
            background-size: contain !important;
        }
    </style>
    <?php
}
