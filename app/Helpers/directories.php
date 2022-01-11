<?php

/**
 * Template
 */

/**
 * @return string
 */
function get_template_public_path()
{
    return dirname(get_template_directory_uri()) . '/public';
}

/**
 * @return string
 */
function get_template_resource_path()
{
    return dirname(get_template_directory()) . '/resources';
}

/**
 * @return string
 */
function get_template_views_path()
{
    return dirname(get_template_directory()) . '/resources/views';
}

/**
 * @return string
 */
function get_template_app_path()
{
    return dirname(get_template_directory()) . '/app';
}

/**
 * Stylesheet
 */

/**
 * @return string
 */
function get_stylesheet_public_path()
{
    return dirname(get_stylesheet_directory_uri()) . '/public';
}

/**
 * @return string
 */
function get_stylesheet_resource_path()
{
    return dirname(get_stylesheet_directory()) . '/resources';
}
