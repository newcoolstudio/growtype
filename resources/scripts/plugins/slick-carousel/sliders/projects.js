function projectsSlider() {
  (function($) {
    $(".is-slider-projects").slick({
      infinite: true,
      slidesToShow: 4,
      centerMode: false,
      arrows: false,
      // speed: 8000,
      // autoplaySpeed: 0,
      // cssEase: 'linear',
      slidesToScroll: 4,
      // variableWidth: true,
      dots: false,
      autoplay: false,
      responsive: [{
        breakpoint: 500,
        settings: {
          slidesToShow: 2,
        },
      }],
    })
  })(jQuery);
}

export {projectsSlider};


