function sidebar() {
    /**
     * Collapse child categories
     */
    $('.widget .product-categories[data-children-collapse="true"] .cat-parent').map(function (index, element) {
        if ($(element).hasClass('current-cat-parent') || $(element).hasClass('current-cat')) {
            $(element).find('> a').after('<span class="btn btn-collapse"></span>');
        }
    });

    $('.widget .product-categories[data-children-collapse="true"] .cat-parent .btn-collapse').click(function (event) {
        event.preventDefault();
        if ($(this).parent().hasClass('is-collapsed')) {
            $(this).parent().find('.children').slideDown()
            $(this).parent().removeClass('is-collapsed')
        } else {
            $(this).parent().find('.children').slideUp()
            $(this).parent().addClass('is-collapsed')
        }
    });
}

export {sidebar};


