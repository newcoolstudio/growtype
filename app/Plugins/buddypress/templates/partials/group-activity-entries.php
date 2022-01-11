<?php
/**
 * Group activity template
 *
 * Displays mini activity for groups
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php
	$item_id    = $activity->item_id;
	$group      = groups_get_group( $item_id );
	$item_cover = bp_attachments_get_attachment(
		'url',
		array(
			'object_dir' => 'groups',
			'item_id'    => $item_id,
		)
	);
	?>

<div class="mini-activity group">
	<div class="mini-activity-inner">
		<div class="mini-cover"<?php echo ( ! empty( $item_cover ) && is_string( $item_cover ) ) ? ' style="background-image: url(' . esc_url( $item_cover ) . ')"' : ''; ?>></div>
		<div class="mini-content">
			<div class="mini-avatar">
				<a href="<?php esc_url( bp_group_permalink( $group ) ); ?>">
					<?php
					echo bp_core_fetch_avatar( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						array(
							'item_id' => $item_id,
							'type'    => 'full',
							'object'  => 'group',
						)
					);
					?>
				</a>
			</div>
			<div class="mini-info">
				<h5 class="mini-title"><a href="<?php esc_url( bp_group_permalink( $group ) ); ?>" class="ellipsis"><?php bp_group_name( $group ); ?></a></h5>
				<div class="mini-meta">
					<span class="ellipsis"><i class="uil-globe"></i><?php bp_group_status( $group ); ?></span>
				</div>
			</div>
			<div class="mini-actions">
				<?php bp_group_join_button( $group ); ?>
			</div>
		</div>
	</div>
</div>
