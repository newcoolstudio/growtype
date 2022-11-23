<?php

/**
 * @param $available
 * @param $user
 * @return false|mixed
 * Application passwords section availability
 */
add_filter('wp_is_application_passwords_available_for_user', 'growtype_wp_is_application_passwords_available_for_user', 10, 2);
function growtype_wp_is_application_passwords_available_for_user($available)
{
    $user = wp_get_current_user();

    /**
     * Allow only for administator
     */
    if (!user_can($user, 'manage_options')) {
        $available = false;
    }

    return $available;
}

/**
 * Show extra fields for administrators in user profile
 */
add_action('show_user_profile', 'growtype_user_profile_fields');
add_action('edit_user_profile', 'growtype_user_profile_fields');
add_action("user_new_form", "growtype_user_profile_fields");
function growtype_user_profile_fields($user)
{
    $user_meta = apply_filters('growtype_extend_user_profile_fields', [], $user);

    if (!current_user_can('manage_options') || empty($user_meta)) {
        return false;
    }

    ?>

    <div style="background: #e9e9e9;display: inline-block;width: 100%;padding-left: 20px;">
        <h3><?= __('Extra meta information', 'growtype') ?></h3>
    </div>

    <table class="form-table" style="background: #e9e9e9;display: inline-block;width: 100%;padding-left: 20px;">
        <?php
        foreach ($user_meta as $key => $value) {
            $input_type = 'text';
            if ($value === '1' || $value === '0' || $value === 'true' || $value === 'false') {
                $input_type = 'checkbox';
            }
            ?>
            <tr>
                <th><label for="<?= $key ?>" style="text-transform: capitalize;"><?= str_replace('_', ' ', $key) ?></label></th>
                <td>
                    <input type="<?= $input_type ?>" class="regular-text" name="<?= $key ?>" value='<?php echo $value; ?>' <?= checked(true, filter_var($value, FILTER_VALIDATE_BOOLEAN)) ?> id="<?= $key ?>"/><br/>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php
}
