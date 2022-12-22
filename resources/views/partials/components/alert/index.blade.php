@stack('alert')

@if(growtype_gdpr_alert_enabled())
    @include('partials.components.alert.gdpr')
@endif
