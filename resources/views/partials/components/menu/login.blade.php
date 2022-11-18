@if(has_nav_menu('header-login') && !is_user_logged_in())
    <?php
    wp_nav_menu(array (
        'theme_location' => 'header-login',
        'menu_id' => 'login-menu',
        'menu_class' => 'menu nav ' . (get_theme_mod('header_menu_uppercase') ? 'menu-uppercase' : ''),
        'walker' => new Growtype_Nav_Walker()
    ));
    ?>
@endif
