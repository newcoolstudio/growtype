function sidebarProducts() {

    if ($('.cat-item').hasClass('current-cat')) {
        $('.sidebar .widget .product-categories').fadeIn();
        $('.sidebar .widget .children').fadeIn();
    }

    $('.widget').click(function () {
        if ($(this).find('.current-cat').length === 0) {
            $(this).find('ul').toggle();
        }
    });

    $('.widget .cat-item, .widget ul').click(function (event) {
        event.stopPropagation();
    });
}

export {sidebarProducts};


