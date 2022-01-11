<?php
/**
 * Auction bid form template
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post;

if ( ! ( $product && $product->get_type() == 'auction' ) ) {
	return;
}
$current_user     = wp_get_current_user();
$product_id       = $product->get_id();
$user_max_bid     = $product->get_user_max_bid( $product_id, $current_user->ID );
$max_min_bid_text = $product->get_auction_type() == 'reverse' ? esc_html__( 'Your min bid is', 'wc_simple_auctions' ) : esc_html__( 'Your max bid is', 'wc_simple_auctions' );
?>

<?php if ( ( $product->is_closed() === false ) and ( $product->is_started() === true ) ) : ?>	

	<?php do_action( 'woocommerce_before_bid_form' ); ?>

	<form class="auction_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo esc_attr( $product_id ); ?>">

		<?php do_action( 'woocommerce_before_bid_button' ); ?>

		<input type="hidden" name="bid" value="<?php echo esc_attr( $product_id ); ?>" />	
		
		<div class="quantity buttons_added">

			<input type="button" value="-" class="minus" />

			<input type="text" name="bid_value" 
				data-auction-id="<?php echo esc_attr( $product_id ); ?>"
			<?php if ( $product->get_auction_sealed() != 'yes' ) { ?> 
				value="<?php echo esc_attr( $product->bid_value() ); ?>" 
			<?php } ?>

			<?php
			if ($product->get_auction_sealed() != 'yes'){
				if ( $product->get_auction_type() == 'reverse' ) { ?>
					max="<?php echo esc_attr( $product->bid_value() ); ?>" 
				<?php } else { ?>
					min="<?php echo esc_attr( $product->bid_value() ); ?>" 
				<?php } ?>
			<?php } ?>
				step="<?php echo $product->get_increase_bid_value() ?>"
				size="<?php echo strlen( $product->get_curent_bid() ) + 2; ?>" 
				title="bid" 
				class="input-text qty bid text left" 
			/>
			<input type="button" value="+" class="plus" />
		</div>

		<button type="submit" class="bid_button button alt"><?php echo apply_filters( 'bid_text', esc_html__( 'Bid', 'wc_simple_auctions' ), $product ); ?></button>
		
		<input type="hidden" name="place-bid" value="<?php echo esc_attr( $product_id ); ?>" />
		<input type="hidden" name="product_id" value="<?php echo esc_attr( $product_id ); ?>" />

		<?php if ( is_user_logged_in() ) { ?>
			<input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />
		<?php } ?> 

		<?php do_action( 'woocommerce_after_bid_button' ); ?>

	</form>	

	<?php do_action( 'woocommerce_after_bid_form' ); ?>		

<?php endif;
