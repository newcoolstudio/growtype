<?php

/**
 * @param $hex
 * @param $opacity
 * @return string
 */
function growtype_hex_to_rgb($hex, $opacity = 1)
{
    $rgb_values = list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");

    return !empty($rgb_values) ? 'rgb(' . implode(' ', $rgb_values) . '/' . $opacity . ')' : '';
}
