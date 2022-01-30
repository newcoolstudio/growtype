function productsSlider() {
  if ($('.is-slider-product .product').length > 1) {
    $(".is-slider-product").slick({
      infinite: true,
      autoplay: false,
      slidesToShow: 4,
      centerMode: false,
      arrows: true,
      speed: 1000,
      autoplaySpeed: 1000,
      slidesToScroll: 1,
      dots: false,
      responsive: [{
        breakpoint: 500,
        settings: {
          slidesToShow: 1,
        },
      }],
    })
  }
}

export {productsSlider};


