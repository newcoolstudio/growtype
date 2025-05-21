<div class="dropdown user-profile">
    <?php do_action('growtype_user_profile_after_open'); ?>

    <button class="dropdown-toggle" type="button" id="user-profile-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="account-img">
            <?php echo get_avatar(get_current_user_id(), 30, '', 'user-profile-avatar'); ?>
        </div>
        <div class="account-details">
            <?php if (!empty(Growtype_User::login_name())) : ?>
            <span class="account-name"><?php echo esc_html(Growtype_User::login_name()); ?></span>
            <?php endif; ?>
        </div>
    </button>
    <ul class="dropdown-menu" aria-labelledby="user-profile-dropdown">
        @if(growtype_user_can_access_platform())
                <?php
                wp_nav_menu(
                    array (
                        'theme_location' => 'user-profile',
                        'depth' => 1,
                        'container' => '',
                        'menu_class' => 'user-profile-menu',
                        'fallback_cb' => '',
                    )
                );
                ?>
        @else
            <ul id="menu-user-profile" class="user-profile-menu">
                <li class="menu-item">
                    <a href="{!! wp_logout_url() !!}">{!! __('Logout', 'growtype') !!}</a>
                </li>
            </ul>
        @endif
    </ul>

    <?php do_action('growtype_user_profile_before_close'); ?>
</div>
