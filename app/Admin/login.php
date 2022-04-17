<?php
/**
 * @param $login_title
 * @return string|string[]
 * Change page title
 */
function custom_login_title($login_title)
{
    return str_replace(array (' &lsaquo;', ' &#8212; WordPress'), array (' &bull;', ''), $login_title);
}

add_filter('login_title', 'custom_login_title');

/**
 * @return string
 * Login logo url
 */
add_filter('login_headerurl', 'login_headerurl_custom');
function login_headerurl_custom()
{
    return get_home_url_custom();
}


/**
 * @return false
 * Scripts
 */
function custom_login_enqueue_scripts()
{
    if (!isset(get_login_logo()['url']) || empty(get_login_logo()['url'])) {
        return false;
    }

    ?>
    <style>
        .login h1 a {
            background-image: url(<?php echo get_login_logo()['url']?>) !important;
            background-position: center center !important;
            width: 240px !important;
            background-size: contain !important;
        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'custom_login_enqueue_scripts');
