jQuery(function ($) {
    $('.growtype-theme-slider').each(function () {
        const $slider = $(this);
        const rawOpts = $slider.attr('data-gslick');
        if (!rawOpts) {
            return;
        }

        let opts;
        try {
            opts = JSON.parse(rawOpts);
        } catch (err) {
            console.error('Failed to parse data-gslick JSON on', this, err);
            return;
        }

        if ($slider.hasClass('slick-initialized')) {
            console.warn('Slider already initialized, skipping:', this);
            return;
        }

        try {
            $slider.on('init', function () {
                // Let lazy re-scan after slick clones slides
                if (window.lazyLoadInstance) {
                    window.lazyLoadInstance.destroy();
                    window.lazyLoadInstance = null;
                }
                if ($.fn.Lazy) {
                    window.lazyLoadInstance = $(".lazy-load").Lazy({
                        scrollDirection: 'vertical',
                        effect: 'fadeIn',
                        visibleOnly: true,
                        chainable: false,
                        threshold: 500
                    });
                }
            });
            $slider.slick(opts);
        } catch (err) {
            console.error('Error initializing slick slider on', this, err);
        }
    });
});
