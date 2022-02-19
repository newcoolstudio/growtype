<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?> >
    <div class="row g-3 main-fields">
        <?php do_action('woocommerce_edit_account_form_start'); ?>

        <div class="b-wrapper col-12 mt-0 pt-3">
            <div class="e-wrapper">
                <h3><?php esc_html_e('Account details', 'growtype'); ?></h3>
            </div>
        </div>

        <div class="e-wrapper col-md-6">
            <label for="account_email" class="form-label"><?php esc_html_e('Email address', 'growtype'); ?>
                <span class="required">*</span></label>
            <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>"/>
        </div>

        <div class="e-wrapper col-md-3">
            <label for="account_first_name" class="form-label"><?php esc_html_e('First name', 'growtype'); ?>
                <span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>"/>
        </div>

        <div class="e-wrapper col-md-3">
            <label for="account_last_name" class="form-label"><?php esc_html_e('Last name', 'growtype'); ?>
                <span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>"/>
        </div>

        <div class="e-wrapper col-md-6">
            <label for="account_display_name" class="form-label"><?php esc_html_e('Display name', 'growtype'); ?>
                <span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->display_name); ?>"/>
        </div>

        <div class="b-wrapper col-12 mt-4 pt-3">
            <div class="e-wrapper">
                <h3><?php esc_html_e('Password details', 'growtype'); ?></h3>
            </div>
        </div>

        <div class="e-wrapper col-md-6">
            <label for="password_current" class="form-label"><?php esc_html_e('Current password (leave blank to leave unchanged)',
                    'growtype'); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off"/>
        </div>

        <div class="e-wrapper col-md-6">
            <label for="password_1" class="form-label"><?php esc_html_e('New password (leave blank to leave unchanged)',
                    'growtype'); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off"/>
        </div>

        <div class="e-wrapper col-md-6">
            <label for="password_2" class="form-label"><?php esc_html_e('Confirm new password', 'growtype'); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off"/>
        </div>

        <?php do_action('woocommerce_edit_account_form'); ?>
    </div>

    <div class="row row-submit mt-4 pb-5 mb-4">
        <div class="d-grid gap-2 d-md-flex">
            <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
            <button type="submit" class="woocommerce-Button button btn btn-primary" name="save_account_details" value="<?php esc_attr_e('Save changes',
                'growtype'); ?>"><?php esc_html_e('Save changes', 'growtype'); ?></button>
            <input type="hidden" name="action" value="save_account_details"/>

            <?php do_action('woocommerce_edit_account_form_end'); ?>
        </div>
    </div>
</form>

<?php do_action('woocommerce_after_edit_account_form'); ?>
