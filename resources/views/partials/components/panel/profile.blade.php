<div class="panel-profile">
    <?php if ( function_exists('bp_is_active') ) : ?>
    <a href="<?php echo esc_url(bp_loggedin_user_domain()); ?>" class="profile-avatar">
        <img src="<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>" alt="<?php echo esc_attr(Growtype_User::display_name()); ?>" class="avatar"/>
    </a>
    <?php else : ?>
    <div class="profile-avatar">
        <img src="<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>" class="avatar"/>
    </div>
    <?php endif; ?>
    <div class="profile-name">
        <?php if ( function_exists('bp_is_active') ) : ?>
        <a href="<?php echo esc_url(bp_loggedin_user_domain()); ?>" class="name ellipsis"><?php echo esc_html(Growtype_User::display_name()); ?></a>
        <?php else : ?>
        <div class="name ellipsis">
            <strong><?php echo esc_html(Growtype_User::display_name()); ?></strong>
        </div>
        <?php endif; ?>
        <?php if ( current_user_can('manage_options') ) : ?>
        <small><?php esc_html_e('Administrator', 'growtype'); ?></small>
        <?php else : ?>
        <small><?php esc_html_e('Member', 'growtype'); ?></small>
        <?php endif; ?>
    </div>
</div>
