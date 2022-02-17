<?php

/**
 * Show extra fields
 */
add_action('woocommerce_edit_account_form', 'add_favorite_color_to_edit_account_form');
function add_favorite_color_to_edit_account_form()
{
    if (class_exists('Growtype_Form')) {
        echo do_shortcode('[growtype_form name="signup_edit" type="fields"]');
    }
}

/**
 * Save extra fields info
 */
add_action('woocommerce_save_account_details', 'save_favorite_color_account_details', 12, 1);
function save_favorite_color_account_details($user_id)
{
    $account_email = $_POST['account_email'];

    $user = get_user_by('id', $user_id);
    $user_login = $user->data->user_login;

    /**
     * Update login email
     */
    if ($account_email !== $user_login) {
        global $wpdb;

        $wpdb->update(
            $wpdb->users,
            ['user_login' => $account_email],
            ['ID' => $user_id]
        );
    }

    if (class_exists('Growtype_Form')) {
        $form_name = $_POST['growtype_form_name'] ?? null;
        if (!empty(Growtype_Form_Crud::get_growtype_form_data($form_name))) {
            $main_fields = Growtype_Form_Crud::get_growtype_form_data($form_name)['main_fields'];

            foreach ($main_fields as $field) {
                if (isset($field['name']) && isset($_POST[$field['name']])) {
                    update_user_meta($user_id, $field['name'], $_POST[$field['name']]);
                }
            }
        }
    }

    apply_filters('growtype_woocommerce_save_account_details', $_POST);

    wp_safe_redirect(wc_get_endpoint_url('edit-account'));
    exit;
}

/**
 * My account page
 */
add_action('woocommerce_edit_account_form_end', 'growtype_woocommerce_after_my_account');
function growtype_woocommerce_after_my_account()
{
    $delete_url = add_query_arg('wc-api', 'wc-delete-account', home_url('/'));
    $delete_url = wp_nonce_url($delete_url, 'wc_delete_user');

    if (!current_user_can('manage_options')) {
        ?>
        <a href="<?php echo $delete_url; ?>" class="btn btn-secondary ms-auto"><?php echo __('Delete Account', 'growtype') ?></a>
        <?php
    }
}

/**
 *
 */
add_action('woocommerce_api_' . strtolower('wc-delete-account'), 'woocommerce_api_wc_delete_account');
function woocommerce_api_wc_delete_account()
{
    if (!current_user_can('manage_options')) {
        $security_check_result = check_admin_referer('wc_delete_user');
        if ($security_check_result) {
            require_once(ABSPATH . 'wp-admin/includes/user.php');

            wp_delete_user(get_current_user_id());
            wp_redirect(home_url());
            die();
        }
    }
}
