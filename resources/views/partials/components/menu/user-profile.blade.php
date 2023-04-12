<div class="dropdown user-profile">
    <button class="dropdown-toggle" type="button" id="user-profile-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="account-img">
            <?php echo get_avatar(get_current_user_id(), 30); ?>
        </div>
        <div class="account-details">
            <?php if (function_exists('bp_is_active')) : ?>
            <span class="account-name"><?php echo esc_html(bp_core_get_username(get_current_user_id())); ?></span>
            <?php elseif (Growtype_User::login_name()) : ?>
            <span class="account-name"><?php echo esc_html(Growtype_User::login_name()); ?></span>
            <?php endif; ?>
        </div>
    </button>
    <ul class="dropdown-menu" aria-labelledby="user-profile-dropdown">
        @if(user_can_access_platform())
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
</div>
