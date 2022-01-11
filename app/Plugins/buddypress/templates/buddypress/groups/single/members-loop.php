<?php
/**
 * Group Members Loop template
 *
 * @since 3.0.0
 * @version 3.2.0
 */
?>

<?php if ( bp_group_has_members( bp_ajax_querystring( 'group_members' ) ) ) : ?>

	<?php bp_nouveau_group_hook( 'before', 'members_content' ); ?>

	<?php bp_nouveau_group_hook( 'before', 'members_list' ); ?>

	<ul id="members-list" class="<?php bp_nouveau_loop_classes(); ?>">

		<?php
		while ( bp_group_members() ) :
			bp_group_the_member();
			?>

			<li <?php bp_member_class() ?> data-bp-item-id="<?php echo esc_attr( bp_get_group_member_id() ); ?>" data-bp-item-component="members">

				<div class="list-wrap">

					<div class="item-avatar">
						<a href="<?php bp_group_member_domain(); ?>">
							<?php bp_group_member_avatar(); ?>
						</a>
					</div>

					<div class="item">

						<div class="item-block">
							<h5 class="list-title member-name"><?php bp_group_member_link(); ?></h5>

							<p class="joined item-meta mute">
								<?php bp_group_member_joined_since(); ?>
							</p>

							<?php if ( bp_is_active( 'friends' ) || bp_is_active( 'groups' ) ) : ?>
								<ul class="connections">
									<?php if ( bp_is_active( 'friends' ) ) : ?>
										<li><span class="count"><?php bp_total_friend_count( bp_get_member_user_id() ); ?></span><p class="mute"><?php esc_html_e( 'Friends', 'growtype' ); ?></p></li>
									<?php endif; ?>
									<?php if ( bp_is_active( 'groups' ) ) : ?>
										<li><span class="count"><?php bp_total_group_count_for_user( bp_get_member_user_id() ); ?></span><p class="mute"><?php esc_html_e( 'Groups', 'growtype' ); ?></p></li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>

							<?php $user_update = trim( str_replace( 'View', '', wp_strip_all_tags( bp_get_activity_latest_update( bp_get_member_user_id() ) ) ) ); ?>
							<p class="latest-update">
								<?php if ( strlen( $user_update ) > 48 ) : ?>
									<?php echo esc_html( substr( $user_update, 0, 45 ) . '...' ); ?>
								<?php else : ?>
									<?php echo esc_html( $user_update ); ?>
								<?php endif; ?>
							</p>

							<?php bp_nouveau_group_hook( '', 'members_list_item' ); ?>

							<?php
							bp_nouveau_members_loop_buttons(
								array(
									'container'      => 'ul',
									'button_element' => 'button',
								)
							);
							?>
						</div>

					</div>

				</div><!-- // .list-wrap -->

			</li>

		<?php endwhile; ?>

	</ul>

	<?php bp_nouveau_group_hook( 'after', 'members_list' ); ?>

	<?php bp_nouveau_pagination( 'bottom' ); ?>

	<?php bp_nouveau_group_hook( 'after', 'members_content' ); ?>

	<?php
else :

	bp_nouveau_user_feedback( 'group-members-none' );

endif;
