<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form'); ?>

<div class="u-columns" id="customer_login">

    <div class="u-column1 col-12">

        <h3 class="e-title text-center p-4">
            <?php esc_html_e('Sign in', 'growtype'); ?>
        </h3>

        <form class="woocommerce-form woocommerce-form-login login container-sm ps-4 pe-4 pb-4" method="post">

            <?php do_action('woocommerce_login_form_start'); ?>

            <div class="mb-3">
                <label for="username">
                    <?php esc_html_e('Username or email address', 'growtype'); ?> <span class="required">*</span>
                </label>
                <input type="text" class="form-control" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
            </div>

            <div class="mb-3">
                <label for="password"><?php esc_html_e('Password', 'growtype'); ?>&nbsp;<span class="required">*</span></label>
                <input class="form-control" type="password" name="password" id="password" autocomplete="current-password"/>
            </div>

            <?php do_action('woocommerce_login_form'); ?>

            <div class="mb-3 row">
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" name="rememberme" type="checkbox" id="rememberme" value="forever"/>
                        <label class="form-check-label" for="exampleCheck1"><?php esc_html_e('Remember me',
                                'growtype'); ?></label>
                    </div>
                </div>
                <div class="col-auto ms-auto mt-1">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?',
                            'growtype'); ?></a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-grid">
                    <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                    <button type="submit" class="btn btn-primary woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e('Log in',
                        'growtype'); ?>"><?php esc_html_e('Log in', 'growtype'); ?></button>
                </div>
            </div>

            <?php do_action('woocommerce_login_form_end'); ?>

        </form>

        <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

        <div class="text-center ps-4 pe-4 pb-4">
            <label><?php esc_html_e("Don't have an account?", 'growtype'); ?></label>
            <a href="#register" class="e-switchform e-register"><?php esc_html_e("Create here", 'growtype'); ?></a>
        </div>

        <?php endif; ?>

    </div>

    <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

    <div class="u-column2 col-12">

        <h3 class="e-title text-center p-4">
            <?php esc_html_e('Register', 'growtype'); ?>
        </h3>

        <form method="post" class="woocommerce-form woocommerce-form-register register ps-4 pe-4" <?php do_action('woocommerce_register_form_tag'); ?> >

            <?php do_action('woocommerce_register_form_start'); ?>

            <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

            <div class="mb-3">
                <label for="reg_username"><?php esc_html_e('Username', 'growtype'); ?>
                    &nbsp;<span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
            </div>

            <?php endif; ?>

            <div class="mb-3">
                <label for="reg_email"><?php esc_html_e('Email address', 'growtype'); ?>
                    &nbsp;<span class="required">*</span></label>
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
            </div>

            <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

            <div class="mb-3">
                <label for="reg_password"><?php esc_html_e('Password', 'growtype'); ?>
                    &nbsp;<span class="required">*</span></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password"/>
            </div>

            <?php else : ?>

            <p><?php esc_html_e('A password will be sent to your email address.', 'growtype'); ?></p>

            <?php endif; ?>

            <?php do_action('woocommerce_register_form'); ?>

            <div class="row mt-4">
                <div class="col-12 d-grid">
                    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                    <button type="submit" class="btn btn-primary woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register',
                        'growtype'); ?>"><?php esc_html_e('Register', 'growtype'); ?></button>
                </div>
            </div>

            <?php do_action('woocommerce_register_form_end'); ?>

        </form>

        <div class="text-center p-4">
            <label><?php esc_html_e("Already have an account?", 'growtype'); ?></label>
            <a href="#login" class="e-switchform e-login"><?php esc_html_e("Login here", 'growtype'); ?></a>
        </div>

    </div>

    <?php endif; ?>

</div>


<?php do_action('woocommerce_after_customer_login_form'); ?>
