<?php
/**
 * Member photos
 *
 * Renders displayed user photos
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="widget">
	<h5 class="widget-title"><?php esc_html_e( 'My photos', 'beehive' ); ?></h5>
	<ul class="member-photo-list">
		<?php foreach ( $results as $result ) : ?>
			<?php $source = wp_get_attachment_image_src( $result->media_id, 'rt_media_thumbnail' ); ?>
			<li class="rtmedia-list-media rtm-gallery-list member-photo">
				<div class="inner">
					<a href="<?php echo esc_url( get_rtmedia_permalink( rtmedia_id( $result->media_id ) ) ); ?>">
						<img src="<?php echo esc_url( $source[0] ); ?>" alt="<?php echo esc_attr( $result->media_title ); ?>">
					</a>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
