<div class="side-nav-wrapper">
    <?php
    if (has_nav_menu('header-side')) {
        wp_nav_menu(array (
            'theme_location' => 'header-side',
            'container_class' => 'side-nav',
            'menu_id' => 'header-side-menu',
            'menu_class' => 'menu nav',
            'walker' => new Growtype_Nav_Walker()
        ));
    }
    ?>

    <?php do_action('growtype_side_nav'); ?>
</div>
