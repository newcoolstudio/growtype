/**
 * Email template
 */
wp.customize('woocommerce_email_page_template', function (value) {
    value.bind(function (newval) {
        $("#sub-accordion-section-woocommerce_email_page li[id*='main_content']").slideUp();
        if (newval.length > 0) {
            wp.customize.previewer.previewUrl(window.location.origin + '/documentation/examples/email/preview?action=previewemail&email_type=' + newval + '&order_id=' + window.preview_order_id);
            $("#sub-accordion-section-woocommerce_email_page li[id*=" + newval.toLowerCase() + "]").slideDown();
        }
    });
});
