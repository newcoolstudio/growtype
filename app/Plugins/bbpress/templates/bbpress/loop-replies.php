<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>

<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies">

	<li class="bbp-header">

		<div class="bbp-reply-author"><?php esc_html_e( 'Author', 'bbpress' ); ?></div><!-- .bbp-reply-author -->

		<div class="bbp-reply-content">

			<?php if ( ! bbp_show_lead_topic() ) : ?>

				<?php esc_html_e( 'Posts', 'bbpress' ); ?>

				<?php bbp_topic_subscription_link(); ?>

				<?php bbp_user_favorites_link(); ?>

			<?php else : ?>

				<?php esc_html_e( 'Replies', 'bbpress' ); ?>

			<?php endif; ?>

		</div><!-- .bbp-reply-content -->

	</li><!-- .bbp-header -->

	<li class="bbp-body">

		<?php if ( bbp_thread_replies() ) : ?>

			<?php bbp_list_replies(); ?>

		<?php else : ?>

			<?php
			while ( bbp_replies() ) :
				bbp_the_reply();
				?>

				<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</li><!-- .bbp-body -->

</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
