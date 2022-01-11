<?php

function hoursRange($lower = 0, $upper = 86400, $step = 3600, $format = '')
{
    $times = array ();

    if (empty($format)) {
        $format = 'H:i';
    }

    foreach (range($lower, $upper, $step) as $increment) {
        $increment = gmdate('H:i', $increment);

        list($hour, $minutes) = explode(':', $increment);

        $date = new DateTime($hour . ':' . $minutes);

        $times[(string)$increment] = $date->format($format);
    }

    return $times;
}
