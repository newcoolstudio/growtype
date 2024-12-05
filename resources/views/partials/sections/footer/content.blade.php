@if(has_nav_menu( 'footer' ) || !empty(get_theme_mod('footer_extra_content')) || !empty(growtype_get_footer_logo()['url']))
    <div class="footer-inner-top">
        <div class="row">
            <div class="footer-inner-content col-12 flex-wrap">
                @if(has_nav_menu( 'footer' ))
                    <div class="c-footernav">
                        @php wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu', 'walker' => new Growtype_Nav_Walker())); @endphp
                    </div>
                @endif
                @if(!empty(growtype_get_footer_extra_content()))
                    <div class="col-12">
                        <div class="footer-extra-content">
                            {!! growtype_get_footer_extra_content() !!}
                        </div>
                    </div>
                @endif
                <div class="footer-logo-wrapper">
                    @if(!empty(growtype_get_footer_logo()['url']))
                        <a id="footer_logo" href="<?php echo growtype_get_home_url() ?>" class="mainlogo">
                            <img class="img-fluid" src="{{growtype_get_footer_logo()['url']}}" alt="footer_logo">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<div class="footer-inner-bottom">
    @if(!empty(growtype_get_footer_copyright()) && get_theme_mod('footer_copyright_enabled',true))
        <div id="footer_copyright" class="copyright">
                <?php echo growtype_get_footer_copyright() ?>
        </div>
    @endif

    @include('partials.components.credits')
</div>
