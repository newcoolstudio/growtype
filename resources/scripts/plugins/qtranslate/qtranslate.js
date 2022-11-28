function qtranslate() {
    (function ($) {
        $('.language-chooser li.active').click(function (e) {
            event.preventDefault();
            event.stopPropagation();
        });
    })(jQuery);
}

export {qtranslate};
