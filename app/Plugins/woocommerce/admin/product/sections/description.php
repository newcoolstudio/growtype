<?php
/**
 * Move default wordpress editor to custom tab
 */

function custom_description($post_type, $post)
{
    add_meta_box(
        'description_box', // id, used as the html id att
        __('Product long description'), // meta box title
        'custom_description_meta_box', // callback function, spits out the content
        'product', // post type or page. This adds to posts only
        'normal', // context, where on the screen
        'high' // priority, where should this go in the context
    );
}

add_action('add_meta_boxes', 'custom_description', 10, 2);

function custom_description_meta_box($post)
{
    echo '<div id="wp-editor-wrapper"></div>';
}

function custom_admin_js($post)
{
    if (get_post_type() === 'product') {
        echo '"<script type="text/javascript">
            if(typeof(document.getElementById("wp-editor-wrapper")) != "undefined" && document.getElementById("wp-editor-wrapper") != null){
             document.getElementById("wp-editor-wrapper").appendChild(
                document.getElementById("postdivrich")
            );   
            }
        </script>"';
    }
}

add_action('admin_footer', 'custom_admin_js');

function custom_description_css()
{
    if (get_post_type() === 'product') { ?>
        <style>
            #wp-content-editor-tools {
                background: none;
            }
        </style>
    <?php } ?>
    <?php
}

add_action('admin_head', 'custom_description_css');
