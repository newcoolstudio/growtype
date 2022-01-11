function tabAccordionHorizontal() {
    let accordionIsSelected = false;
    $('.b-accordion-horizontal .b-accordion--tab').click(function () {
        if (!accordionIsSelected) {
            if (!$(this).hasClass('is-active')) {
                accordionIsSelected = true;
                let tab_nr = $(this).data('nr');

                $('.b-accordion-horizontal .b-accordion--tab').removeClass('is-active');
                $(this).addClass('is-active');

                $('.b-accordion-horizontal .b-accordion--content').fadeOut().promise().done(function () {
                    accordionIsSelected = false;
                    $('.b-accordion-horizontal .b-accordion--content').removeClass('is-active');
                    $('.b-accordion-horizontal .b-accordion--content[data-nr="' + tab_nr + '"]').fadeIn().addClass('is-active');
                });
            }
        }
    });
}

export {tabAccordionHorizontal};
