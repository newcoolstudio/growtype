<?php

add_action('growtype_head_viewport', 'growtype_head_viewport_render');

function growtype_head_viewport_render()
{
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <?php
}
