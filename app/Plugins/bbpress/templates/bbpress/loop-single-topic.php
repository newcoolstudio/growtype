<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<ul id="bbp-topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

	<li class="bbp-topic-title">

		<span class="bbp-title-icon topic-icon color-secondary"><span class="dashicons dashicons-format-chat"></span></span>

		<?php if ( bbp_is_user_home() ) : ?>

			<?php if ( bbp_is_favorites() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>

					<?php
					bbp_topic_favorite_link(
						array(
							'before'    => '',
							'favorite'  => '<i class="uil-star"></i>',
							'favorited' => '<i class="uil-star-half-alt"></i>',
						)
					);
					?>

					<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>

				</span>

			<?php elseif ( bbp_is_subscriptions() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>

					<?php
					bbp_topic_subscription_link(
						array(
							'before'      => '',
							'subscribe'   => '<i class="uil-comment-plus"></i>',
							'unsubscribe' => '<i class="uil-minus-circle"></i>',
						)
					);
					?>

					<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>

				</span>

			<?php endif; ?>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_topic_title' ); ?>

		<p><strong><a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a></strong></p>

		<?php do_action( 'bbp_theme_after_topic_title' ); ?>

		<?php bbp_topic_pagination(); ?>

		<?php do_action( 'bbp_theme_before_topic_meta' ); ?>

		<p class="bbp-topic-meta mute">

			<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>

			<span class="bbp-topic-started-by">
				<?php
					// translators: topic author.
					printf( esc_html__( 'Started by: %1$s', 'bbpress' ), bbp_get_topic_author_link( array( 'size' => '14' ) ) );
				?>
			</span>

			<?php do_action( 'bbp_theme_after_topic_started_by' ); ?>

			<?php if ( ! bbp_is_single_forum() || ( bbp_get_topic_forum_id() !== bbp_get_forum_id() ) ) : ?>

				<?php do_action( 'bbp_theme_before_topic_started_in' ); ?>

				<span class="bbp-topic-started-in">
					<?php
						// translators: topic in forum.
						printf( esc_html__( 'in: %1$s', 'bbpress' ), '<a href="' . bbp_get_forum_permalink( bbp_get_topic_forum_id() ) . '">' . bbp_get_forum_title( bbp_get_topic_forum_id() ) . '</a>' );
					?>
				</span>

				<?php do_action( 'bbp_theme_after_topic_started_in' ); ?>

			<?php endif; ?>

		</p>

		<?php do_action( 'bbp_theme_after_topic_meta' ); ?>

		<?php bbp_topic_row_actions(); ?>

	</li>

	<li class="bbp-topic-voice-count bbp-topic-color"><?php bbp_topic_voice_count(); ?></li>

	<li class="bbp-topic-reply-count bbp-post-color">		
		<?php if ( bbp_show_lead_topic() ) : ?>
			<?php bbp_topic_reply_count(); ?>
		<?php else : ?>
			<?php bbp_topic_post_count(); ?>
		<?php endif; ?>
	</li>

	<li class="bbp-topic-freshness">

		<p class="bbp-topic-meta">

			<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>

			<span class="bbp-topic-freshness-author">
			<?php
			bbp_author_link(
				array(
					'post_id' => bbp_get_topic_last_active_id(),
					'type'    => 'name',
				)
			);
			?>
			</span>

			<?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>

		</p>

		<?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>

		<span class="mute"><?php bbp_topic_freshness_link(); ?></span>

		<?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>

	</li>

</ul><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
