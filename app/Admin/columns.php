<?php

/**
 * Preview Column
 */
add_filter('manage_posts_columns', 'growtype_manage_posts_columns', 5);
add_filter('manage_pages_columns', 'growtype_manage_posts_columns', 5);
function growtype_manage_posts_columns($columns)
{
    if (!class_exists('WooCommerce') || get_post_type() !== 'product') {
        $columns['featured_image'] = __('Featured image');
        $columns['slug'] = __('Slug');
    }

    $columns['growtype_excerpt'] = __('Excerpt');

    return $columns;
}

/**
 * Column content
 */
add_action('manage_posts_custom_column', 'grotype_manage_posts_custom_column', 5, 2);
add_action('manage_pages_custom_column', 'grotype_manage_posts_custom_column', 5, 2);
function grotype_manage_posts_custom_column($column_name)
{
    if ($column_name === 'featured_image') {
        echo the_post_thumbnail('thumbnail');
    }

    if ($column_name === 'slug') {
        global $post;
        echo $post->post_name;
    }

    if ($column_name === 'growtype_excerpt') {
        global $post;
        echo class_exists('QTX_Translator') ? qtranxf_useCurrentLanguageIfNotFoundShowEmpty($post->post_excerpt) : $post->post_excerpt;
    }
}

/**
 * Column style
 */
add_action('admin_head', 'growtype_admin_manage_posts_columns');
function growtype_admin_manage_posts_columns()
{
    echo '<style>';
    echo '.wp-admin .wp-list-table #categories { width:8%; }';
    echo '.wp-admin .wp-list-table #slug { width:8%; }';
    echo '.wp-admin .wp-list-table #growtype_excerpt { width:15%!important; }';
    echo '.wp-admin .wp-list-table #language { width:8%!important; }';
    echo '.wp-admin .wp-list-table #featured_image { width:8%!important; }';
    echo '.wp-admin .wp-list-table .featured_image img { max-width:100%;height:initial; }';
    echo '</style>';
}

/**
 * Hide excerpt when Extended view
 */
add_filter('get_the_excerpt', function ($excerpt) {
    global $pagenow;

    if ($pagenow === 'edit.php') {
        $excerpt = '';
    }

    return $excerpt;
}, 100);

/**
 *
 */
add_action('quick_edit_custom_box', 'growtype_quick_edit_custom_box', 10, 3);
function growtype_quick_edit_custom_box($column_name, $post_type, $taxonomy)
{
    global $post;

    switch ($column_name) {
        case 'growtype_excerpt':
            if ($column_name === 'growtype_excerpt'): ?>
                <fieldset class="inline-edit-col-right" id="#edit-">
                    <div class="inline-edit-col">
                        <label class="inline-edit-tags">
                            <span class="title"><?php echo __('Excerpt') ?></span>
                            <textarea cols="22" rows="1" name="growtype_excerpt" class="ui-autocomplete-input"></textarea>
                        </label>
                    </div>
                </fieldset>
            <?php
            endif;
            break;
    }
}

/**
 *
 */
add_filter('wp_insert_post_data', 'growtype_wp_insert_post_data', '99', 1);
function growtype_wp_insert_post_data($data)
{
    if (function_exists('growtype_format_translation') && isset($_POST) && isset($_POST['growtype_excerpt'])) {
        $data['post_excerpt'] = growtype_format_translation(qtranxf_getLanguage(), $data['post_excerpt'], $_POST['growtype_excerpt']);
    }

    return $data; // Returns the modified data.
}

/**
 * Add excerpt
 */
add_action('admin_print_footer_scripts-edit.php', function ($page) { ?>
    <script>
        jQuery(function ($) {

            const wp_inline_edit_function = inlineEditPost.edit;

            // we overwrite the it with our own
            inlineEditPost.edit = function (post_id) {

                // let's merge arguments of the original function
                wp_inline_edit_function.apply(this, arguments);

                // get the post ID from the argument
                if (typeof (post_id) == 'object') { // if it is object, get the ID number
                    post_id = parseInt(this.getId(post_id));
                }

                // add rows to variables
                const edit_row = $('#edit-' + post_id)
                const post_row = $('#post-' + post_id)

                $('textarea[name="growtype_excerpt"]', edit_row).val($('.growtype_excerpt', post_row).text());
            }
        });
    </script>
    <?php
});
