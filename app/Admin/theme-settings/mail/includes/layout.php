<div class="wrap">
    <h1>Mail Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('mail_options_settings');
        do_settings_sections('growtype-mail-settings');
        submit_button();
        ?>
    </form>
</div>
