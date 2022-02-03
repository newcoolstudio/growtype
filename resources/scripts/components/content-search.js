function contentSearch() {
    $('.e-search').click(function () {
        if ($('.search-main').is(':visible')) {
            $('.search-main').fadeOut();
        } else {
            $('.search-main').fadeIn();
            $('#search-form').focus();
        }
    });

    $('.search-main .btn-close').click(function (e) {
        e.preventDefault();
        $('.search-main').fadeOut();
    });
}

export {contentSearch};
