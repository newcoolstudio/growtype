function details() {
    function isAdminOrEditor() {
        if (!document.body) return false;
        return document.body.classList.contains('wp-admin') ||
            document.body.classList.contains('block-editor-page');
    }

    function initAccordion() {
        if (isAdminOrEditor()) return;

        const $accordions = jQuery('.wp-block-growtype-accordion-details');

        $accordions.each(function () {
            const $accordion = jQuery(this);
            const singleOpen = $accordion.data('single-open') === true || $accordion.data('single-open') === 'true';

            $accordion.find('.wp-block-growtype-detail-item').each(function () {
                const $item = jQuery(this);
                const $summary = $item.find('.details-summary').first();
                const $content = $item.find('.detail-content');

                // Close by default
                if (!$item.hasClass('is-open')) {
                    $content.hide();
                }

                $summary.on('click', function (e) {
                    e.preventDefault();

                    const isOpen = $item.hasClass('is-open');

                    if (singleOpen) {
                        // Close all others
                        $accordion.find('.wp-block-growtype-detail-item.is-open').each(function () {
                            if (this !== $item[0]) {
                                jQuery(this)
                                    .removeClass('is-open')
                                    .find('.detail-content')
                                    .stop(true, true)
                                    .slideUp(300);
                            }
                        });
                    }

                    if (isOpen) {
                        $item.removeClass('is-open');
                        $content.stop(true, true).slideUp(300);
                    } else {
                        $item.addClass('is-open');
                        $content.stop(true, true).slideDown(300);
                    }
                });
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAccordion);
    } else {
        initAccordion();
    }
}

export { details };
