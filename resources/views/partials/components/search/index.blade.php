@stack('search')

@if(Growtype_Search::enabled())
    @include('partials.components.search.main')
@endif
