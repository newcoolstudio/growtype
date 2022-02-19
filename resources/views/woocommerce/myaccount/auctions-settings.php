<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

	<?php do_action( 'woocommerce_auctions_settings_form_start' ); ?>
	 <?php
	 	$user_auctions_closing_soon_emails = get_user_meta(get_current_user_id(), 'auctions_closing_soon_emails', true) !== '0' ? '1' : '0';
	 	woocommerce_form_field( 'auctions_closing_soon_emails', array(
        'type'          => 'checkbox',
        'class'         => array('input-checkbox'),
        'label'         => esc_html__('Get email notification for my auctions ending soon', 'wc_simple_auctions'),
        'required'  => false,
        'default' => 1
        ), $user_auctions_closing_soon_emails );

       ?>

	<div class="clear pt-3"></div>

	<?php do_action( 'woocommerce_auctions_settings_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_auctions_settings' ); ?>
		<input type="submit" class="woocommerce-Button button" name="save_auctions_settings" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
		<input type="hidden" name="action" value="save_auctions_settings" />
	</p>

	<?php do_action( 'woocommerce_auctions_settings_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_auctions_settings_form' );
