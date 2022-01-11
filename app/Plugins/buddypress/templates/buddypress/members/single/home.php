<?php
/**
 * BuddyPress - Members Home
 *
 * @since   1.0.0
 * @version 3.0.0
 */
?>

<?php bp_nouveau_member_hook('before', 'home_content'); ?>

<div id="item-header" role="complementary" data-bp-item-id="<?php echo esc_attr(bp_displayed_user_id()); ?>" data-bp-item-component="members" class="users-header single-headers">

    <?php bp_nouveau_member_header_template_part(); ?>

</div><!-- #item-header -->

<div class="bp-wrap">

    <?php bp_get_template_part('members/single/parts/item-nav'); ?>

    <div id="item-body" class="item-body">
        <div class="row">
            <div class="col-lg-3 profile-col-aside left">
                <aside class="widget-area profile-widget-area displayed-profile-info">
                    <?php do_action('before_displayed_profile_info'); ?>
                    <?php if (bp_is_active('friends') || bp_is_active('groups')) : ?>
                        <div class="widget">
                            <ul class="connections">
                                <?php if (bp_is_active('friends')) : ?>
                                    <li><span class="count color-primary"><?php bp_total_friend_count(bp_get_member_user_id()); ?></span><p><?php echo __('Friends', 'growtype'); ?></p></li>
                                <?php endif; ?>
                                <?php if (bp_is_active('groups')) : ?>
                                    <li><span class="count color-primary"><?php bp_total_group_count_for_user(bp_get_member_user_id()); ?></span><p><?php echo __('Groups', 'growtype') ?></p></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php do_action('after_displayed_profile_info'); ?>
                </aside>
            </div>

            <div class="col-lg-9 profile-col-main">
                <?php bp_nouveau_member_template_part(); ?>
            </div>
        </div>
    </div><!-- #item-body -->

</div><!-- // .bp-wrap -->

<?php bp_nouveau_member_hook('after', 'home_content'); ?>
