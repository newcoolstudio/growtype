@if(get_theme_mod('footer_is_disabled') !== true)
    <footer id="site-footer" class="site-footer site-footer-{{get_theme_mod('footer_type_select')}}" role="contentinfo">
        <div class="container footer-inner">

            @include('partials.sections.footer.footer-type-1')

            <div class="footer-inner-bottom">

                @if(!empty(get_theme_mod('footer_copyright')))
                    <div id="footer_copyright" class="copyright">
                        <?php echo get_theme_mod('footer_copyright') ?>
                    </div>
                @endif

                @if(get_theme_mod('footer_type_select') !== 'type-3')
                    @include('partials.components.social-icons')
                @else
                    @include('partials.components.credits')
                @endif
            </div>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
@endif
