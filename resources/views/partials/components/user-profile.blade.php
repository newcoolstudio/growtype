<div class="dropdown user-profile">
    <button class="dropdown-toggle" type="button" id="user-profile-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo get_avatar( get_current_user_id(), 30 ); ?>
        <?php if ( function_exists( 'bp_is_active' ) ) : ?>
        <span class="account-name"><?php echo esc_html( bp_core_get_username( get_current_user_id() ) ); ?></span>
        <?php elseif ( get_current_user_login_name() ) : ?>
        <span class="account-name"><?php echo esc_html( get_current_user_login_name() ); ?></span>
        <?php endif; ?>
    </button>
    <ul class="dropdown-menu" aria-labelledby="user-profile-dropdown">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'user-profile',
                'depth'          => 1,
                'container'      => '',
                'menu_class'     => 'user-profile-menu',
                'fallback_cb'    => '',
            )
        );
        ?>
    </ul>
</div>