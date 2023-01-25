<div class="footer-inner-top">
    <div class="footer-inner-content row">
        <div class="col-12 col-md-5 col-xl-7">
            <div class="c-footernav">
                @php wp_nav_menu(array('theme_location' => 'footer', 'menu_class' => 'menu menu-column-'.count(get_menu_parent_items('footer')).'', 'menu_id' => 'footer-menu', 'walker' => new Growtype_Nav_Walker())); @endphp
            </div>
        </div>
        <div class="col-12 col-md-7 col-xl-5">
            <div class="footer-extra-content">
                {!! get_theme_mod('footer_extra_content') !!}
            </div>
        </div>
    </div>

    @if(Growtype_Social::icons_enabled() || !empty(growtype_get_footer_logo()['url']))
        <div class="row pt-4">
            <div class="col-12 text-center">
                @include('partials.components.social-icons')
                @if(!empty(growtype_get_footer_logo()['url']))
                    <a id="footer_logo" href="<?php echo get_home_url_custom() ?>" class="mainlogo mx-auto">
                        <img class="img-fluid" src="{{growtype_get_footer_logo()['url']}}" style="padding-top: 0;" alt="footer_logo">
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
<div class="footer-inner-bottom">
    @if(!empty(get_theme_mod('footer_copyright')) && !get_theme_mod('footer_copyright_disabled'))
        <div id="footer_copyright" class="copyright">
                <?php echo get_theme_mod('footer_copyright'); ?>
        </div>
    @endif

    @include('partials.components.social-icons')

    @include('partials.components.credits')
</div>
