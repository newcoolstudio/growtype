function tabAccordionVertical() {
    $('.b-accordion-vertical .b-accordion--tab').click(function () {
        if (!$(this).hasClass('is-active')) {
            let tab_nr = $(this).data('nr');

            $('.b-accordion-vertical .b-accordion--tab').removeClass('is-active');
            $(this).addClass('is-active');
            $('.b-accordion-vertical .b-accordion--content').slideUp().removeClass('is-active');
            $('.b-accordion-vertical .b-accordion--content[data-nr="' + tab_nr + '"]').slideDown().addClass('is-active')
        } else {
            $('.b-accordion-vertical .b-accordion--tab').removeClass('is-active');
            $('.b-accordion-vertical .b-accordion--content').slideUp().removeClass('is-active');
        }
    });
}

export {tabAccordionVertical};
