<div class="wrap">
    <h1>Plugin Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('plugin_options_settings');
        do_settings_sections('growtype-plugin-settings');
        submit_button();
        ?>
    </form>
</div>
