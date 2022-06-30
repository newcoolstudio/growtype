@if(!empty(get_theme_mod('header_extra_content')))
    <div class="header-extra-content-wrapper">
        {!! apply_filters( 'the_content', get_theme_mod('header_extra_content') ) !!}
    </div>
@endif
