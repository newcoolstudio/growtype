<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>"/>
    <?php echo get_bloginfo('name', 'display'); ?>
</head>
<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container">
                    <?php
                    if ($img = get_option('woocommerce_email_header_image')) { ?>
                        <tr>
                            <td align="center" valign="top">
                                <!-- Header -->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header">
                                    <tr>
                                        <td id="header_wrapper" align="center" style="padding-bottom: 25px;padding-top: 30px;">
                                            <img width="210" src="<?php echo esc_url($img) ?>" style="margin-right: 0;"/>
                                        </td>
                                    </tr>
                                </table>
                                <!-- End Header -->
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                    if (get_theme_mod('woocommerce_email_page_header_title_switch') !== false) {
                        if (!empty($email_heading)) { ?>
                            <tr>
                                <td align="center" valign="top">
                                    <!-- Header -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header">
                                        <tr>
                                            <td id="header_wrapper" style="padding-top: 25px;padding-bottom: 25px;">
                                                <h1><?php echo $email_heading; ?></h1>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- End Header -->
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                    <tr>
                        <td align="center" valign="top">
                            <!-- Body -->
                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
                                <tr>
                                    <td valign="top" id="body_content">
                                        <!-- Content -->
                                        <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                            <tr>
                                                <td valign="top" style="padding-top: 30px">
                                                    <div id="body_content_inner">
