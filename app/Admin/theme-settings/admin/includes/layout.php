<div class="wrap">
    <h1>Admin Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('admin_options_settings');
        do_settings_sections('growtype-admin-settings');
        submit_button();
        ?>
    </form>
</div>
