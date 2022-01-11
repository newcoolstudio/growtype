<?php

/**
 * Icons enabling
 */

function tinymce_scripts()
{
    wp_enqueue_style('feather-icons', get_template_directory_uri() . '/../app/Admin/editor/standard/visual/tinymce/css/feather-icons.css');
}

add_action('admin_enqueue_scripts', 'tinymce_scripts');

/**
 * Overal tinymce style
 */

function tinymce_style()
{
    add_editor_style(dirname(get_template_directory_uri()) . '/app/Admin/editor/standard/visual/tinymce/css/style.css');
}

add_action('admin_init', 'tinymce_style');

/**
 * Tinymce button
 */

//function tinymce_buttons($buttons)
//{
//    return array (
//        'bold',
//        'italic',
//        'underline',
//        'bullist',
//        'numlist',
//        'blockquote',
//        'justifyleft',
//        'justifycenter',
//        'justifyright',
//        'justifyfull',
//        'link',
//        'unlink',
//        'anchor',
//        'wp_more',
//        'wp_fullscreen',
//        'wp_adv',
//        'style_formats',
//        'table'
//    );
//}
//
//add_filter('mce_buttons', 'tinymce_buttons');
//
//function tinymce_buttons_2($buttons)
//{
//    return array (
//        'formatselect',
//        'pastetext',
//        'pasteword',
//        'sub',
//        'sup',
//        'charmap',
//        'hr',
//        'removeformat',
//        'undo',
//        'redo',
//        'code'
//    );
//}
//
//add_filter('mce_buttons_2', 'tinymce_buttons_2');

/**
 * Custom tags
 */

add_filter('mce_buttons', 'leaven_mce_editor_buttons');
function leaven_mce_editor_buttons($buttons)
{
    $buttons[] = 'styleselect';
    return $buttons;
}

add_filter('tiny_mce_before_init', 'leaven_modify_mce_styles');
function leaven_modify_mce_styles($init_array)
{
    // Define the style_formats array
    $style_formats = array (
        array (
            'title' => 'Uppercase text',
            'inline' => 'span',
            'styles' => array (
                'textTransform' => 'uppercase'
            )
        ),
        array (
            'title' => 'Button primary',
            'selector' => 'a',
            'classes' => 'btn-primary'
        ),
        array (
            'title' => 'Button secondary',
            'selector' => 'a',
            'classes' => 'btn-secondary'
        )
    );

    if(get_theme_mod('secondary_font_select_switch')){
        array_push($style_formats, array (
            'title' => 'Font style secondary',
            'inline' => 'span',
            'styles' => array (
                'font-family' => json_decode(get_theme_mod('secondary_font_select'))->font
            )
        ));
    }

    $init_array['style_formats'] = wp_json_encode($style_formats);
    return $init_array;
}

/**
 * @param $initArray
 * @return mixed
 * to prevent removing empty span
 */
function override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');

function tiny_mce_register_buttons($buttons)
{
    $newBtns = array (
        'myblockquotebtn'
    );
    $buttons = array_merge($buttons, $newBtns);
    return $buttons;
}

add_action('init', 'tiny_mce_new_buttons');

function tiny_mce_new_buttons()
{
    add_filter('mce_buttons', 'tiny_mce_register_buttons');
}

/**
 * Grid elements
 */

include('elements/grid.php');

/**
 * Extra styles
 */

include('elements/extra-styles.php');
