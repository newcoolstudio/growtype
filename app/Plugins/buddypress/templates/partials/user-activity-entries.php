<?php
/**
 * User activity template
 *
 * Displays mini activity for users
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php
if ( 'friendship_created' === $activity->type ) {
	if ( bp_is_user() && bp_displayed_user_id() != $activity->user_id ) {
		$item_id = $activity->user_id;
	} else {
		$item_id = $activity->secondary_item_id;
	}
} else {
	$item_id = $activity->user_id;
}

$item_cover = bp_attachments_get_attachment(
	'url',
	array(
		'object_dir' => 'members',
		'item_id'    => $item_id,
	)
);
?>

<div class="buddypress-mini-activity member">
	<div class="mini-activity-inner">
		<div class="mini-cover"<?php echo ( ! empty( $item_cover ) && is_string( $item_cover ) ) ? ' style="background-image: url(' . esc_url( $item_cover ) . ')"' : ''; ?>></div>
		<div class="mini-content">
			<div class="mini-avatar">
				<a href="<?php echo esc_url( bp_core_get_user_domain( $item_id ) ); ?>">
					<?php
					echo bp_core_fetch_avatar( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						array(
							'item_id' => $item_id,
							'type'    => 'full',
							'object'  => 'user',
						)
					);
					?>
				</a>
			</div>
			<div class="mini-info">
				<h5 class="mini-title"><a href="<?php echo esc_url( bp_core_get_user_domain( $item_id ) ); ?>" class="ellipsis"><?php echo bp_core_get_user_displayname( $item_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></h5>
				<div class="mini-meta">
					<span class="ellipsis"><i class="uil-at"></i><?php echo bp_core_get_username( $item_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</div>
			</div>
			<div class="mini-actions">
				<?php
				if ( bp_is_active( 'friends' ) ) {
					bp_add_friend_button( $item_id ); }
				?>
			</div>
		</div>
	</div>
</div>
