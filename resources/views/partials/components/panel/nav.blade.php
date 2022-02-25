<div class="panel-nav">
    <?php
    wp_nav_menu(
        array (
            'theme_location' => 'panel',
            'container_class' => 'panel-menu item',
            'menu_class' => 'navbar-panel',
            'walker' => new Custom_Nav_Walker()
        )
    );
    ?>
</div>
