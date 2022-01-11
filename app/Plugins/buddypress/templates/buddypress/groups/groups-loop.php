<?php
/**
 * BuddyPress - Groups Loop
 *
 * @since 3.0.0
 * @version 7.0.0
 */

bp_nouveau_before_loop(); ?>

<?php if ( bp_get_current_group_directory_type() ) : ?>
	<p class="current-group-type"><?php bp_current_group_directory_type_message(); ?></p>
<?php endif; ?>

<?php if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>

	<ul id="groups-list" class="<?php bp_nouveau_loop_classes(); ?>">

	<?php
	while ( bp_groups() ) :
		bp_the_group();
		?>

		<li <?php bp_group_class(); ?> data-bp-item-id="<?php bp_group_id(); ?>" data-bp-item-component="groups">
			<div class="list-wrap">

				<?php if ( bp_nouveau_loop_is_grid() && ! bp_disable_group_cover_image_uploads() ) : ?>
					<?php
					$group_cover = bp_attachments_get_attachment(
						'url',
						array(
							'object_dir' => 'groups',
							'item_id'    => bp_get_group_id(),
						)
					);
					?>
					<div class="item-cover"<?php echo ( ! empty( $group_cover ) && is_string( $group_cover ) ) ? ' style="background-image: url(' . esc_url( $group_cover ) . ')"' : ''; ?>></div>
				<?php endif; ?>

				<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
					<div class="item-avatar">
						<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( bp_nouveau_avatar_args() ); ?></a>
					</div>
				<?php endif; ?>

				<div class="item">

					<div class="item-block">

						<h5 class="list-title groups-title"><?php bp_group_link(); ?></h5>

						<p class="last-activity item-meta mute">
							<?php
								printf(
									/* translators: %s: last activity timestamp (e.g. "Active 1 hour ago") */
									esc_html__( 'Active %s', 'buddypress' ),
									sprintf(
										'<span data-livestamp="%1$s">%2$s</span>',
										bp_core_get_iso8601_date( bp_get_group_last_active( 0, array( 'relative' => false ) ) ),
										esc_html( bp_get_group_last_active() )
									)
								);
							?>
						</p>

						<?php if ( bp_nouveau_loop_is_grid() ) : ?>
							<?php
							if ( bp_group_has_members(
								array(
									'group_id'            => bp_get_group_id(),
									'exclude_admins_mods' => false,
									'max'                 => 5,
								)
							) ) :
								?>
							<ul class="inline-members">
								<?php
								while ( bp_group_members() ) :
									bp_group_the_member();
									?>

									<li>
										<a href="<?php bp_group_member_domain(); ?>" title="<?php bp_group_member_name(); ?>" target="_blank">
											<?php bp_group_member_avatar( 'type=thumb&width=35&height=35' ); ?>
										</a>
									</li>
								<?php endwhile; ?>
							</ul>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( bp_nouveau_group_has_meta() ) : ?>

							<p class="item-meta group-details"><?php bp_nouveau_group_meta(); ?></p>

						<?php endif; ?>

						<?php bp_nouveau_groups_loop_item(); ?>

						<?php
						bp_nouveau_groups_loop_buttons(
							array(
								'container'      => 'ul',
								'button_element' => 'button',
							)
						);
						?>

					</div>

				</div>

			</div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php bp_nouveau_pagination( 'bottom' ); ?>

<?php else : ?>

	<?php bp_nouveau_user_feedback( 'groups-loop-none' ); ?>

<?php endif; ?>

<?php
bp_nouveau_after_loop();
