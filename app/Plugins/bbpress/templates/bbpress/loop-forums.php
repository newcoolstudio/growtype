<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>

<ul id="forums-list-<?php bbp_forum_id(); ?>" class="bbp-forums">

	<li class="bbp-header">

		<ul class="forum-titles">
			<li class="bbp-forum-info"><?php esc_html_e( 'Forum', 'bbpress' ); ?></li>
			<li class="bbp-forum-topic-count"><?php esc_html_e( 'Topics', 'bbpress' ); ?></li>
			<li class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? esc_html_e( 'Replies', 'bbpress' ) : esc_html_e( 'Posts', 'bbpress' ); ?></li>
			<li class="bbp-forum-freshness"><?php esc_html_e( 'Last Post', 'bbpress' ); ?></li>
		</ul>

	</li><!-- .bbp-header -->

	<li class="bbp-body">

		<?php
		while ( bbp_forums() ) :
			bbp_the_forum();
			?>

			<?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

	</li><!-- .bbp-body -->

</ul><!-- .forums-directory -->

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
