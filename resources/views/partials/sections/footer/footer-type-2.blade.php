@if(has_nav_menu( 'footer' ) || !empty(get_theme_mod('footer_textarea')) || !empty(get_footer_logo()['url']))
    <div class="footer-inner-top">
        <div class="row">
            <div class="col-12 flex-wrap">
                @if(has_nav_menu( 'footer' ))
                    <div class="c-footernav">
                        @php wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu', 'walker' => new Custom_Nav_Walker())); @endphp
                    </div>
                @endif
                @if(!empty(get_theme_mod('footer_textarea')))
                    <div id="footer_textarea">
                        {!! get_theme_mod('footer_textarea') !!}
                    </div>
                @endif
                @if(!empty(get_footer_logo()['url']))
                    <a id="footer_logo" href="<?php echo get_home_url_custom() ?>" class="mainlogo">
                        <img class="img-fluid" src="{{get_footer_logo()['url']}}" alt="footer_logo">
                    </a>
                @endif
            </div>
        </div>
    </div>
@endif

<div class="footer-inner-bottom">
    @if(!empty(get_theme_mod('footer_copyright')))
        <div id="footer_copyright" class="copyright">
            <?php echo get_theme_mod('footer_copyright'); ?>
        </div>
    @endif

    @include('partials.components.social-icons')

    @include('partials.components.credits')
</div>
