@include('partials.sections.intro.post')
@include('partials.sections.content')
@include('plugins.acf.flexible-content')

@if(!get_theme_mod('post_single_page_related_posts_disabled'))
    @include('partials.sections.related-posts')
@endif
