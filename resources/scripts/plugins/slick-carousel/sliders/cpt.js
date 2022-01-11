function cptSlider() {
  (function($) {
    $(".is-slider-cpt").slick({
      infinite: true,
      slidesToShow: 2,
      centerMode: false,
      arrows: true,
      // speed: 8000,
      // autoplaySpeed: 0,
      // cssEase: 'linear',
      slidesToScroll: 1,
      // variableWidth: true,
      dots: false,
      autoplay: false,
      responsive: [{
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
        },
      },
        {
          breakpoint: 408,
          settings: {
            slidesToShow: 1,
            arrows: false,
            dots: true,
          },
        }],
    })
  })(jQuery);
}

export {cptSlider};


