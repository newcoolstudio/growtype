$ = jQuery;
wp.customize.bind('ready', function () {
    jQuery.ajax({
        url: ajax_object.ajaxurl,
        type: 'post',
        data: {
            action: 'qtranslate_fields_parse',
        },
        success: function (response) {
            var responseResult = JSON.parse(response);
            setTimeout(function () {
                Object.entries(responseResult).map(function (value, index) {
                    var elementInput = $('input[data-customize-setting-link="' + value[0] + '"]');
                    var elementTextarea = $('textarea[data-customize-setting-link="' + value[0] + '"]');
                    elementInput.val(value[1]);
                    elementTextarea.val(value[1]);
                    if (tinymce.get(value[0]) !== null) {
                        tinymce.get(value[0]).setContent(value[1]);
                    }

                    if (value[0] === 'blogname') {
                        $('.panel-title.site-title').text(value[1])
                    }
                });
            }, 1000)
        }
    });
});
