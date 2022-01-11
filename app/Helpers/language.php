<?php

function language_selector()
{
    $disabled = get_theme_mod('language_selector_disabled') ?? false;

    return class_exists('qTranslateXWidget') && !$disabled ? true : false;
}
