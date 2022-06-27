<?php

/**
 * Quicktags
 */

function add_pre_and_div_quicktags()
{
    if (wp_script_is('quicktags')) {
        ?>
        <script type="text/javascript">
            QTags.addButton('button_code', 'button', '<button class="btn btn-primary">', '</button>', '', 'Button tag', 1);
            QTags.addButton('title_code', 'title', '<div class="e-title">', '</div>', '', 'Title', 1);
            QTags.addButton('subtitle_code', 'subtitle', '<div class="e-subtitle">', '</div>', '', 'Subtitle', 1);
            QTags.addButton('row', 'row', '<div class="row">', '</div>', '', 'row', 1);
            QTags.addButton('container', 'container', '<div class="container">', '</div>', '', 'container', 1);
            QTags.addButton('column_6', 'col-md-6', '<div class="col-md-6">', '</div>', '', 'col-md-6', 1);
            QTags.addButton('column_4', 'col-md-4', '<div class="col-md-4">', '</div>', '', 'col-md-4', 1);
            QTags.addButton('column_8', 'col-md-8', '<div class="col-md-8">', '</div>', '', 'col-md-8', 1);
            QTags.addButton('column_12', 'col-12', '<div class="col-12">', '</div>', '', 'col-12', 1);
        </script>
        <?php
    }
}

add_action('admin_print_footer_scripts', 'add_pre_and_div_quicktags', 1000);

