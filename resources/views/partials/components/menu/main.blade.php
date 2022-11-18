<nav id="site-navigation" class="main-navigation main-navigation-{{!empty(get_theme_mod('main_navigation_menu_type_select')) ? get_theme_mod('main_navigation_menu_type_select') : 'standard'}} {{get_theme_mod('header_menu_always_visible') ? 'main-navigation-always-visible' : ''}}" role="navigation">
    <?php
    wp_nav_menu(array (
        'theme_location' => 'header',
        'container_class' => 'menu-header-container',
        'menu_id' => 'header-menu',
        'menu_class' => 'menu nav ' . (get_theme_mod('header_menu_uppercase') ? 'menu-uppercase' : ''),
        'walker' => new Growtype_Nav_Walker()
    ));
    ?>
</nav><!-- #site-navigation -->
