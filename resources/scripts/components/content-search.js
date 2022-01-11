function contentSearch() {
    $('.e-search').click(function () {
        if ($('.b-mainsearch').is(':visible')) {
            $('.b-mainsearch').fadeOut();
        } else {
            $('.b-mainsearch').fadeIn();
            $('#search-form').focus();
        }
    });

    $('.b-mainsearch .e-close').click(function () {
        $('.b-mainsearch').fadeOut();
    });
}

export {contentSearch};
