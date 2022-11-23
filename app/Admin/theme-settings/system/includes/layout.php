<div class="wrap">
    <h1>System Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('framework_options_settings');
        do_settings_sections('growtype-system-settings');
        submit_button();
        ?>
    </form>
</div>
