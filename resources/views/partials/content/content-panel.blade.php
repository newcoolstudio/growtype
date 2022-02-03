<div id="panel" class="panel panel-area panel-<?php echo esc_html(get_theme_mod('panel_style')) ?>">
    <div class="panel-header">
        @include('partials.components.panel.logo')
    </div>

    @if(get_theme_mod('panel_show_user_profile'))
        <div class="panel-profile">
            <?php if ( function_exists('bp_is_active') ) : ?>
            <a href="<?php echo esc_url(bp_loggedin_user_domain()); ?>" class="profile-avatar">
                <img src="<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>" alt="<?php echo esc_attr(get_current_user_display_name()); ?>" class="avatar"/>
            </a>
            <?php else : ?>
            <div class="profile-avatar">
                <img src="<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>" class="avatar"/>
            </div>
            <?php endif; ?>
            <div class="profile-name">
                <?php if ( function_exists('bp_is_active') ) : ?>
                <a href="<?php echo esc_url(bp_loggedin_user_domain()); ?>" class="name ellipsis"><?php echo esc_html(get_current_user_display_name()); ?></a>
                <?php else : ?>
                <div class="name ellipsis">
                    <strong><?php echo esc_html(get_current_user_display_name()); ?></strong>
                </div>
                <?php endif; ?>
                <?php if ( current_user_can('manage_options') ) : ?>
                <small><?php esc_html_e('Administrator', 'growtype'); ?></small>
                <?php else : ?>
                <small><?php esc_html_e('Member', 'growtype'); ?></small>
                <?php endif; ?>
            </div>
        </div>
    @endif

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

    <div class="panel-bg"></div>
</div>
