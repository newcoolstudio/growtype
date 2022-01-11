jQuery(document).ready(function ($) {

    tinymce.create('tinymce.plugins.ExtraStylesButton', {
        init: function (ed, url) {

            ed.addButton('extra_styles', {
                title: 'Content extra styles',
                icon: 'activity feather-icon icon-edit-3',
                onclick: function () {
                    ed.windowManager.open({
                        title: 'Content extra styles',
                        width: 400,
                        height: 100,
                        body: [
                            {
                                type: 'textbox',
                                name: 'maxwidth',
                                label: 'Max width (in px or %)',
                                value: ''
                            },
                            {
                                type: 'textbox',
                                name: 'fontsize',
                                label: 'Font size',
                                value: ''
                            },
                        ],
                        onsubmit: function (e) {
                            var selectedContent = ed.selection.getContent();
                            ed.selection.dom.setStyle(ed.selection.getNode(), 'max-width', e.data.maxwidth)
                            ed.selection.dom.setStyle(ed.selection.getNode(), 'font-size', e.data.fontsize + 'px')
                            // if (e.data.width > 0) {
                            //     ed.selection.setContent('<div style="max-width: ' + e.data.width + 'px;">' + selectedContent + '</div>');
                            // }
                        }
                    });
                }
            });

        },
        createControl: function (n, cm) {
            return null;
        }
    });

    tinymce.PluginManager.add('extra_styles_script', tinymce.plugins.ExtraStylesButton);
});
