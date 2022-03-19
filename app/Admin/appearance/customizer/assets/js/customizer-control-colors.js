wp.customize("bg_color_scheme", function (value) {
    value.bind(function (newval) {
        var colors = colorScheme[newval].general;
        $('#customize-control-body_background_color input.wp-color-picker').wpColorPicker('color', colors['body_background_color']);
        $('#customize-control-body_text_color input.wp-color-picker').wpColorPicker('color', colors['body_text_color']);
        $('#customize-control-header_background_color input.wp-color-picker').wpColorPicker('color', colors['header_background_color']);
        $('#customize-control-header_text_color input.wp-color-picker').wpColorPicker('color', colors['header_text_color']);
        $('#customize-control-header_text_color_scroll input.wp-color-picker').wpColorPicker('color', colors['header_text_color_scroll']);
        $('#customize-control-header_text_color_home input.wp-color-picker').wpColorPicker('color', colors['header_text_color_home']);
        $('#customize-control-footer_background_color input.wp-color-picker').wpColorPicker('color', colors['footer_background_color']);
        $('#customize-control-footer_text_color input.wp-color-picker').wpColorPicker('color', colors['footer_text_color']);
        $('#customize-control-header_navbar_background_color input.wp-color-picker').wpColorPicker('color', colors['header_navbar_background_color']);
        $('#customize-control-header_navbar_elements_color input.wp-color-picker').wpColorPicker('color', colors['header_navbar_elements_color']);
        $('#customize-control-header_promo_background_color input.wp-color-picker').wpColorPicker('color', colors['header_promo_background_color']);
        $('#customize-control-header_promo_elements_color input.wp-color-picker').wpColorPicker('color', colors['header_promo_elements_color']);
    });
});
