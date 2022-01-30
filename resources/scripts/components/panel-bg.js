function panelBg() {
    let panelBackground = $('.panel .panel-bg');

    if (panelBackground.length > 0) {
        $(window).on("load resize", function () {
            let panelHeight = $('body').height();
            if ($('#site-footer').length > 0) {
                panelHeight = panelHeight - $('#site-footer').height()
            }
            panelBackground.height(panelHeight)
        })
    }
}

export {panelBg};
