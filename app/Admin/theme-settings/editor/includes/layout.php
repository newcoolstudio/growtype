<div class="wrap">
    <h1>Editor Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('editor_options_settings');
        do_settings_sections('growtype-editor-settings');
        submit_button();
        ?>
    </form>
</div>
