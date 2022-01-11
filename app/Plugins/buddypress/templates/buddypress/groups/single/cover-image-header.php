<?php
/**
 * BuddyPress - Groups Cover Image Header.
 *
 * @since 3.0.0
 * @version 7.0.0
 */
?>

<div id="cover-image-container">

	<div id="header-cover-image"></div>

	<div id="item-header-cover-image">
		<div class="row">

			<div class="col-lg-3">
				<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
					<div id="item-header-avatar">
						<a href="<?php echo esc_url( bp_get_group_permalink() ); ?>" title="<?php echo esc_attr( bp_get_group_name() ); ?>">

							<?php bp_group_avatar(); ?>

						</a>
						<h3 class="profile-name"><?php bp_group_name(); ?></h3>
					</div><!-- #item-header-avatar -->
				<?php endif; ?>
			</div>

			<div class="col-lg-9">
	<?php if ( ! bp_nouveau_groups_front_page_description() ) : ?>
				<div id="item-header-content">

					<?php if ( bp_nouveau_group_has_meta( 'status' ) ) : ?>
						<p class="highlight group-status"><strong><?php echo esc_html( bp_nouveau_the_group_meta( array( 'keys' => 'status' ) ) ); ?></strong></p>
					<?php endif; ?>

					<p class="activity">
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

					<?php
					bp_group_type_list(
						bp_get_group_id(),
						array(
							'label'        => array(
								'plural'   => __( 'Group Types', 'buddypress' ),
								'singular' => __( 'Group Type', 'buddypress' ),
							),
							'list_element' => 'span',
						)
					);
					?>

					<?php bp_nouveau_group_hook( 'before', 'header_meta' ); ?>

					<?php if ( bp_nouveau_group_has_meta_extra() ) : ?>
						<div class="item-meta">

							<?php echo bp_nouveau_the_group_meta( array( 'keys' => 'extra' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

						</div><!-- .item-meta -->
					<?php endif; ?>

					<?php bp_nouveau_group_header_buttons(); ?>

				</div><!-- #item-header-content -->
	<?php endif; ?>
			</div>

		</div>

		<?php bp_get_template_part( 'groups/single/parts/header-item-actions' ); ?>

	</div><!-- #item-header-cover-image -->

</div><!-- #cover-image-container -->
