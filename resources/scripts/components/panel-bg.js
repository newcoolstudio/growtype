function panelBg() {
    let panelBackground = $('.panel .panel-bg');

    if (panelBackground.length > 0) {

        document.addEventListener('filterProductsByOrder', function () {
            setTimeout(function () {
                setPanelHeight();
            }, 500);
        });

        $(window).on("load resize", function () {
            setPanelHeight();
        })
    }

    function setPanelHeight() {
        let panelHeight = $('body').height();
        if ($('#site-footer').length > 0) {
            panelHeight = panelHeight - $('#site-footer').height()
        }
        if($(window).width() > 992){
          panelBackground.height(panelHeight)
        }
    }
}

export {panelBg};
