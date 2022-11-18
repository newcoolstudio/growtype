@stack('alert')

@if(display_gdpr())
    @include('partials.components.alert.gdpr')
@endif
