@if(!empty(get_the_content()))
    @include('partials.sections.content')
@endif

@include('plugins.acf.flexible-content')
