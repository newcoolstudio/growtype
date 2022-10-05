<?php

/**
 *
 */
class Growtype_Language
{
    /**
     * @return bool
     */
    public static function selector()
    {
        $disabled = get_theme_mod('language_selector_disabled') ?? false;

        return class_exists('qTranslateXWidget') && !$disabled ? true : false;
    }

    /**
     * @return bool
     */
    public static function selector_classes()
    {
        $classes = [];
        $individual = get_theme_mod('language_selector_individual_mode') ?? false;
        $text = get_theme_mod('language_selector_text_mode') ?? false;

        if ($individual) {
            array_push($classes, 'individual-mode');
        }

        if ($text) {
            array_push($classes, 'text-mode');
        }

        return implode(' ', $classes);
    }
}
