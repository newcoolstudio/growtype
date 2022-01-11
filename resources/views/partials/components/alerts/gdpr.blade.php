<div id="alert-gdpr" class="alert alert-secondary alert-font-sm alert-dismissible fade show alert-position-{!! empty(get_theme_mod('theme_general_gdpr_position')) ? 'bottom' : get_theme_mod('theme_general_gdpr_position'); !!}" role="alert" style="display: none;">
    {!! get_theme_mod('theme_general_gdpr_content') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@push('footerScripts')
    <script>
        if (cookieCustom.getCookie('gdpr_showed') !== 'true') {
            $('#alert-gdpr').fadeIn();
        }
        $('#alert-gdpr').on('closed.bs.alert', function () {
            cookieCustom.setCookie('gdpr_showed', true)
        })
    </script>
@endpush
