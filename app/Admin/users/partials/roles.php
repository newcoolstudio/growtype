<?php

class Growtype_Admin_Users_Roles
{
    /**
     * Roles excluded from the multi-role checkbox list.
     */
    const EXCLUDED_ROLES = ['administrator'];

    public function __construct()
    {
        // Multi-role checkbox UI — replaces the native single-select for admins
        add_action('edit_user_profile', [$this, 'render_multi_role_section'], 5);
        add_action('show_user_profile', [$this, 'render_multi_role_section'], 5);
        add_action('edit_user_profile_update', [$this, 'save_multi_roles']);
        add_action('personal_options_update', [$this, 'save_multi_roles']);

        // Hide the native single-select role dropdown for admins
        add_action('admin_head-user-edit.php', [$this, 'hide_native_role_select']);
        add_action('admin_head-profile.php', [$this, 'hide_native_role_select']);
    }

    /**
     * Inject CSS to hide the native single-select role dropdown for admins.
     */
    public function hide_native_role_select()
    {
        if (!current_user_can('manage_options')) {
            return;
        }
        echo '<style>.user-role-wrap { display: none !important; }</style>';
    }

    /**
     * Render multi-role checkboxes on the user edit screen.
     * Skipped for administrator accounts.
     */
    public function render_multi_role_section($user)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        if (in_array('administrator', (array) $user->roles, true)) {
            return;
        }

        $all_roles  = wp_roles()->roles;
        $user_roles = (array) $user->roles;
        $excluded   = self::EXCLUDED_ROLES;
        ?>
        <h2>Roles</h2>
        <table class="form-table">
            <tr>
                <th><label>Assigned Roles</label></th>
                <td>
                    <?php foreach ($all_roles as $role_slug => $role_data) :
                        if (in_array($role_slug, $excluded, true)) {
                            continue;
                        }
                        $checked = in_array($role_slug, $user_roles, true);
                    ?>
                        <label style="display:inline-block; margin-right:18px; margin-bottom:8px;">
                            <input type="checkbox"
                                   name="growtype_user_roles[]"
                                   value="<?php echo esc_attr($role_slug); ?>"
                                   <?php checked($checked); ?>>
                            <?php echo esc_html(translate_user_role($role_data['name'])); ?>
                        </label>
                    <?php endforeach; ?>
                    <p class="description" style="margin-top:8px;">
                        Check all roles this user should have. At least one must remain selected.
                    </p>
                </td>
            </tr>
        </table>
        <?php
    }

    /**
     * Save multi-role checkboxes.
     */
    public function save_multi_roles($user_id)
    {
        // Verify the WP user-edit nonce to prevent CSRF
        check_admin_referer('update-user_' . $user_id);

        if (!current_user_can('manage_options')) {
            return;
        }

        $user = get_userdata($user_id);

        if (in_array('administrator', (array) $user->roles, true)) {
            return;
        }

        if (!isset($_POST['growtype_user_roles'])) {
            return;
        }

        $allowed_roles   = array_keys(wp_roles()->roles);
        $excluded        = self::EXCLUDED_ROLES;
        $submitted_roles = array_map('sanitize_key', (array) $_POST['growtype_user_roles']);

        $new_roles = array_values(array_filter($submitted_roles, function ($r) use ($allowed_roles, $excluded) {
            return in_array($r, $allowed_roles, true) && !in_array($r, $excluded, true);
        }));

        if (empty($new_roles)) {
            return; // Safety: never strip all roles
        }

        foreach ((array) $user->roles as $existing_role) {
            if (!in_array($existing_role, $excluded, true)) {
                $user->remove_role($existing_role);
            }
        }

        foreach ($new_roles as $role) {
            $user->add_role($role);
        }

        // Prevent WordPress from overwriting our multi-role assignment.
        // edit_user_profile_update fires before WP calls edit_user() → wp_update_user(),
        // which reads $_POST['role'] and calls set_role() — replacing all roles with one.
        // Unsetting it here stops that from happening.
        unset($_POST['role']);
    }
}

new Growtype_Admin_Users_Roles();
