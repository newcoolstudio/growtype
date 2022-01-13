<?php

/**
 * Parent template
 */

/**
 * @return string
 */
function get_parent_template_public_path()
{
    return dirname(get_template_directory_uri()) . '/public';
}

/**
 * @return string
 */
function get_parent_template_resource_path()
{
    return dirname(get_template_directory()) . '/resources';
}

/**
 * @return string
 */
function get_parent_template_views_path()
{
    return dirname(get_template_directory()) . '/resources/views';
}

/**
 * @return string
 */
function get_parent_template_app_path()
{
    return dirname(get_template_directory()) . '/app';
}

/**
 * Child template
 */

/**
 * @return string
 */
function get_child_template_public_path()
{
    return dirname(get_stylesheet_directory_uri()) . '/public';
}

/**
 * @return string
 */
function get_child_template_resource_path()
{
    return dirname(get_stylesheet_directory()) . '/resources';
}
