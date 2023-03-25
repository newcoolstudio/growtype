<?php

/**
 * @return string
 */
function growtype_get_parent_theme_public_path()
{
    return dirname(get_template_directory_uri()) . '/public';
}

/**
 * @return string
 */
function growtype_get_parent_theme_resource_path()
{
    return dirname(get_template_directory()) . '/resources';
}

/**
 * @return string
 */
function growtype_get_parent_theme_views_path()
{
    return dirname(get_template_directory()) . '/resources/views';
}

/**
 * @return string
 */
function growtype_get_parent_theme_app_path()
{
    return dirname(get_template_directory()) . '/app';
}

/**
 * @return string
 */
function growtype_get_child_theme_public_path()
{
    $path = str_contains('resources', get_stylesheet_directory_uri()) ? dirname(get_stylesheet_directory_uri()) : get_stylesheet_directory_uri();

    return $path . '/public';
}

/**
 * @return string
 */
function growtype_get_child_theme_resource_path()
{
    return dirname(get_stylesheet_directory()) . '/resources';
}

/**
 * @return string
 */
function growtype_get_child_theme_app_path()
{
    return dirname(get_stylesheet_directory()) . '/app';
}
