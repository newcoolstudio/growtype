<?php
/**
 * BuddyPress - Members Loop
 *
 * @since 3.0.0
 * @version 6.0.0
 */

bp_nouveau_before_loop(); ?>

<?php if ( bp_get_current_member_type() ) : ?>
	<p class="current-member-type"><?php bp_current_member_type_message(); ?></p>
<?php endif; ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<ul id="members-list" class="<?php bp_nouveau_loop_classes(); ?>">

	<?php
	while ( bp_members() ) :
		bp_the_member();
		?>

		<li <?php bp_member_class(); ?> data-bp-item-id="<?php bp_member_user_id(); ?>" data-bp-item-component="members">
			<div class="list-wrap">

				<div class="item-avatar">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar( bp_nouveau_avatar_args() ); ?></a>
				</div>

				<div class="item">

					<div class="item-block">

						<h4 class="list-title member-name">
							<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
						</h4>

						<?php if ( bp_nouveau_member_has_meta() ) : ?>
							<p class="item-meta last-activity mute">
								<?php bp_nouveau_member_meta(); ?>
							</p><!-- .item-meta -->
						<?php endif; ?>

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
						<?php if ( strlen( $user_update ) > 48 ) : ?>
							<p class="latest-update"><?php echo esc_html( substr( $user_update, 0, 45 ) . '...' ); ?></p>
						<?php else : ?>
							<p class="latest-update"><?php echo esc_html( $user_update ); ?></p>
						<?php endif; ?>

						<?php
						bp_nouveau_members_loop_buttons(
							array(
								'container'      => 'ul',
								'button_element' => 'button',
							)
						);
						?>

					</div>

				</div><!-- // .item -->

			</div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php bp_nouveau_pagination( 'bottom' ); ?>

	<?php
else :

	bp_nouveau_user_feedback( 'members-loop-none' );

endif;
?>

<?php bp_nouveau_after_loop(); ?>
