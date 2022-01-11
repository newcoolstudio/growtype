function videoCover() {
    $('.video-cover .wp-block-cover').click(function () {
        var $this = $(this);
        setTimeout(function () {
            $this.fadeOut();
        }, 500)
        $this.closest('.video-cover').find('iframe')[0].src += "&autoplay=1";
    })
}

export {videoCover};
