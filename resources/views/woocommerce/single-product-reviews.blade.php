<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div class="container">
		<div id="comments" class="mb-4">
			<h3 class="e-title-section woocommerce-Reviews-title">
				<?php
				esc_html_e( 'Reviews', 'growtype' );
				?>
			</h3>

			<?php if ( have_comments() ) : ?>
			<ol class="commentlist mt-4">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
						apply_filters(
								'woocommerce_comment_pagination_args',
								array(
										'prev_text' => '&larr;',
										'next_text' => '&rarr;',
										'type'      => 'list',
								)
						)
				);
				echo '</nav>';
			endif;
			?>
			<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'growtype' ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper" class="mb-5">
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				
				$comment_form = array(
					/* translators: %s is product title */
						'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'growtype' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'growtype' ), get_the_title() ),
					/* translators: %s is product title */
						'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'growtype' ),
						'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
						'title_reply_after'   => '</span>',
						'comment_notes_after' => '',
						'label_submit'        => esc_html__( 'Submit', 'growtype' ),
						'logged_in_as'        => '',
						'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				
				$fields              = array(
						'author' => array(
								'label'    => __( 'Name', 'growtype' ),
								'type'     => 'text',
								'value'    => $commenter['comment_author'],
								'required' => $name_email_required,
						),
						'email' => array(
								'label'    => __( 'Email', 'growtype' ),
								'type'     => 'email',
								'value'    => $commenter['comment_author_email'],
								'required' => $name_email_required,
						),
				);

				$comment_form['fields'] = array();

				foreach ( $fields as $key => $field ) {
					$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
					$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

					if ( $field['required'] ) {
						$field_html .= '&nbsp;<span class="required">*</span>';
					}

					$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<div class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'growtype' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</div>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'growtype' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'growtype' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'growtype' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'growtype' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'growtype' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'growtype' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'growtype' ) . '</option>
					</select></div>';
				}

				$comment_form['comment_field'] .= '<div class="comment-form-comment mb-2"><label for="comment">' . esc_html__( 'Your review', 'growtype' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></div>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
		<?php else : ?>
		<div class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'growtype' ); ?></div>
		<?php endif; ?>

		<div class="clear"></div>
	</div>
</div>
