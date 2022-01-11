function memberSlider() {
  (function($) {

    if(window.slickMemberArgs === undefined){
      let slidesToShow = Number($(".is-slider-member").attr('data-slides-to-show'));

      window.slickMemberArgs = {
        infinite: false,
        slidesToShow: slidesToShow,
        // centerMode: true,
        arrows: true,
        // speed: 8000,
        // autoplaySpeed: 0,
        // cssEase: 'linear',
        slidesToScroll: 1,
        // variableWidth: true,
        dots: false,
        autoplay: false,
        responsive: [{
          breakpoint: 500,
          settings: {
            slidesToShow: 2,
          },
        }],
      }
    }

    $(".is-slider-member").slick(window.slickMemberArgs)
  })(jQuery);
}

export {memberSlider};


