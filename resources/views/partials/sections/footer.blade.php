@if(get_theme_mod('footer_is_disabled') !== true)
    <footer id="site-footer" class="site-footer site-footer-{{get_theme_mod('footer_type_select')}}" role="contentinfo">
        <div class="container footer-inner">
            @if(get_theme_mod('footer_type_select') === 'type-1')
                @include('partials.sections.footer.type-1')
            @elseif(get_theme_mod('footer_type_select') === 'type-2')
                @include('partials.sections.footer.type-2')
            @elseif(get_theme_mod('footer_type_select') === 'type-3')
                @include('partials.sections.footer.type-3')
            @endif
        </div>
    </footer>
@endif
