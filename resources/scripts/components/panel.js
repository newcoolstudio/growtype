function panel() {
    let panel = $('.panel');

    if (panel.length > 0) {
        /**
         * Growtype-wc
         */
        document.addEventListener('filterProductsByOrder', function () {
            setTimeout(function () {
                setPanelHeight();
            }, 500);
        });

        $(window).on("load resize", function () {
            setPanelHeight();
        })

        /**
         * ResizeSensor plugin
         */
        if (typeof window['ResizeSensor'] !== "undefined") {
            new ResizeSensor(jQuery('body'), function () {
                setPanelHeight();
            });
        }

        /**
         * Panel open
         */
        $('.btn-panel-open').click(function () {
            $('.panel-area').addClass('is-active');
        });

        $('.btn-panel-close').click(function () {
            $('.panel-area').removeClass('is-active');
        });

        $('.panel-area').click(function () {
            $('.panel-area').removeClass('is-active');
        });

        $('.panel-area .panel-inner').click(function () {
            event.stopPropagation()
        });
    }

    function setPanelHeight() {
        if (!panel.attr('data-auto-height')) {
            return;
        }

        let panelBackground = $('.panel .panel-bg');
        let panelHeight = $('body').height();
        if ($('#site-footer').length > 0) {
            panelHeight = panelHeight - $('#site-footer').height()
        }
        if ($(window).width() > 992) {
            panelBackground.height(panelHeight)
        }
    }
}

export {panel};
