function fancyboxGallery() {
    (function ($) {
        $('.fancybox').fancybox({
            maxWidth: 1200,
        });

        $('.fancybox-project').fancybox({
            maxWidth: 1200,
            wrapCSS: "fancybox-wrap-project",
            arrows: true,
            maxHeight: '85%',
            closeBtn: true,
            loop: true,
            scrollOutside: false,
            topRatio: 0.2,
            afterLoad: function (item) {
                let defaultTitle = this.title;
                if (typeof $(item.element[0]).attr('data-project-preview') !== "undefined" && typeof $(item.element[0]).attr('data-project-order') !== "undefined") {
                    this.title = '<p class="e-title">' + defaultTitle + '</p><div class="project-details">' + $(item.element[0]).attr('data-project-preview') + $(item.element[0]).attr('data-project-order') + '</div>';
                }
            },
            afterShow: function () {
                $('.btn-order').click(function () {
                    cookieCustom.setCookie('project_design', $(this).closest('.child').find('.e-title').text())
                });
            },
        });

        $(".fancybox-popup-trigger").on('click', function () {
            event.preventDefault();
            $.fancybox.open($("#fancybox-popup").clone());
        });
    })(jQuery);
}

export {fancyboxGallery};
