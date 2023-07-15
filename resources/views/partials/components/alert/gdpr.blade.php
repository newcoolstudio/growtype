<div class="alert alert-secondary alert-dismissible growtype-gdpr-alert fade show alert-position-{!! empty(get_theme_mod('growtype_gdpr_alert_position')) ? 'bottom' : get_theme_mod('growtype_gdpr_alert_position'); !!} alert-style-{!! empty(get_theme_mod('growtype_gdpr_alert_style')) ? 'horizontal' : get_theme_mod('growtype_gdpr_alert_style'); !!}" role="alert" style="display: none;">
    <div class="alert-details">
        {!! wpautop( get_theme_mod('growtype_gdpr_alert_content'), true ) !!}
    </div>
    <div class="alert-actions">
        @if(get_theme_mod('growtype_gdpr_alert_agree_btn_enabled'))
            <button type="button" class="btn btn-primary" data-bs-dismiss="alert" aria-label="Close">{!! get_theme_mod('growtype_gdpr_alert_agree_btn_text', __('Close and accept','growtype')) !!}</button>
        @endif
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@push('footerScripts')
    <script>
        if (typeof cookieCustom !== 'undefined' && cookieCustom.getCookie('growtype_gdpr_was_showed') !== 'true') {
            $('.growtype-gdpr-alert').fadeIn();
        }
        $('.growtype-gdpr-alert').on('closed.bs.alert', function () {
            cookieCustom.setCookie('growtype_gdpr_was_showed', true)
        })
    </script>
@endpush
