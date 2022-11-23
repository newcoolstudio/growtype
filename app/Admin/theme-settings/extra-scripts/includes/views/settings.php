<div class="wrap">
    <h2><?php echo $this->plugin->displayName; ?></h2>

    <?php
    if (isset($this->message)) {
        ?>
        <div class="updated fade"><p><?php echo $this->message; ?></p></div>
        <?php
    }
    if (isset($this->errorMessage)) {
        ?>
        <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>
        <?php
    }
    ?>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder">
            <!-- Content -->
            <div id="post-body-content">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                    <div class="postbox">
                        <h3 class="hndle"><?php esc_html_e('Settings', $this->plugin->slug); ?></h3>

                        <div class="inside">
                            <form action="<?php echo $this->plugin->page; ?>?page=<?php echo $this->plugin->slug; ?>" method="post">
                                <?php
                                if (is_multisite() && get_current_blog_id() === 1) { ?>
                                    <h3>Multisite scripts</h3>
                                    <p>
                                        <label for="growtype_insert_multisite_header"><strong><?php esc_html_e('Scripts in Header', $this->plugin->slug); ?></strong></label>
                                        <textarea name="growtype_insert_multisite_header" id="growtype_insert_multisite_header" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['growtype_insert_multisite_header']; ?></textarea>
                                        <?php
                                        printf(
                                        /* translators: %s: The `<head>` tag */
                                            esc_html__('These scripts will be printed in the %s section.', $this->plugin->slug),
                                            '<code>&lt;head&gt;</code>'
                                        );
                                        ?>
                                    </p>
                                    <?php if ($this->body_open_supported) : ?>
                                        <p>
                                            <label for="growtype_insert_multisite_body"><strong><?php esc_html_e('Scripts in Body', $this->plugin->slug); ?></strong></label>
                                            <textarea name="growtype_insert_multisite_body" id="growtype_insert_multisite_body" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['growtype_insert_multisite_body']; ?></textarea>
                                            <?php
                                            printf(
                                            /* translators: %s: The `<head>` tag */
                                                esc_html__('These scripts will be printed just below the opening %s tag.', $this->plugin->slug),
                                                '<code>&lt;body&gt;</code>'
                                            );
                                            ?>
                                        </p>
                                    <?php endif; ?>
                                    <p>
                                        <label for="growtype_insert_multisite_footer"><strong><?php esc_html_e('Scripts in Footer', $this->plugin->slug); ?></strong></label>
                                        <textarea name="growtype_insert_multisite_footer" id="growtype_insert_multisite_footer" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['growtype_insert_multisite_footer']; ?></textarea>
                                        <?php
                                        printf(
                                        /* translators: %s: The `</body>` tag */
                                            esc_html__('These scripts will be printed above the closing %s tag.', $this->plugin->slug),
                                            '<code>&lt;/body&gt;</code>'
                                        );
                                        ?>
                                    </p>

                                    <h3>Local scripts</h3>
                                <?php } ?>

                                <p>
                                    <label for="growtype_insert_header"><strong><?php esc_html_e('Scripts in Header', $this->plugin->slug); ?></strong></label>
                                    <textarea name="growtype_insert_header" id="growtype_insert_header" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['growtype_insert_header']; ?></textarea>
                                    <?php
                                    printf(
                                    /* translators: %s: The `<head>` tag */
                                        esc_html__('These scripts will be printed in the %s section.', $this->plugin->slug),
                                        '<code>&lt;head&gt;</code>'
                                    );
                                    ?>
                                </p>
                                <?php if ($this->body_open_supported) : ?>
                                    <p>
                                        <label for="growtype_insert_body"><strong><?php esc_html_e('Scripts in Body', $this->plugin->slug); ?></strong></label>
                                        <textarea name="growtype_insert_body" id="growtype_insert_body" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['growtype_insert_body']; ?></textarea>
                                        <?php
                                        printf(
                                        /* translators: %s: The `<head>` tag */
                                            esc_html__('These scripts will be printed just below the opening %s tag.', $this->plugin->slug),
                                            '<code>&lt;body&gt;</code>'
                                        );
                                        ?>
                                    </p>
                                <?php endif; ?>
                                <p>
                                    <label for="growtype_insert_footer"><strong><?php esc_html_e('Scripts in Footer', $this->plugin->slug); ?></strong></label>
                                    <textarea name="growtype_insert_footer" id="growtype_insert_footer" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['growtype_insert_footer']; ?></textarea>
                                    <?php
                                    printf(
                                    /* translators: %s: The `</body>` tag */
                                        esc_html__('These scripts will be printed above the closing %s tag.', $this->plugin->slug),
                                        '<code>&lt;/body&gt;</code>'
                                    );
                                    ?>
                                </p>
                                <?php wp_nonce_field($this->plugin->slug, $this->plugin->slug . '_nonce'); ?>
                                <p>
                                    <input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php esc_attr_e('Save', $this->plugin->slug); ?>"/>
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- /postbox -->
                </div>
                <!-- /normal-sortables -->
            </div>
            <!-- /post-body-content -->
        </div>
    </div>
</div>
