function testimonialsSlider() {
    (function ($) {
        let testimonialSlider = $(".s-testimonials--inner");
        testimonialSlider.slick({
            infinite: true,
            slidesToShow: parseInt(testimonialSlider.closest('.s-testimonials').attr('data-amount')),
            centerMode: false,
            arrows: testimonialSlider.closest('.s-testimonials').attr('data-arrows') ? true : false,
            // speed: 8000,
            // autoplaySpeed: 0,
            // cssEase: 'linear',
            slidesToScroll: 1,
            // variableWidth: true,
            dots: false,
            autoplay: false,
            responsive: [
                {
                    breakpoint: 950,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 1,
                    },
                }
            ],
        })
    })(jQuery);
}

export {testimonialsSlider};


