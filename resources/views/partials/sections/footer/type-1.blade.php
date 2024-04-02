<div class="footer-inner-top">
    @if(!empty(growtype_get_footer_logo()['url']))
        <div class="logo-wrapper">
            <a id="footer_logo" href="<?php echo growtype_get_home_url() ?>" class="mainlogo">
                <img class="img-fluid" src="{{growtype_get_footer_logo()['url']}}" alt="footer_logo">
            </a>
        </div>
    @endif
    <div class="footer-inner-content row">
        @if(has_nav_menu('footer'))
            <div class="col-12 col-md-8">
                <div class="c-footernav">
                    @php wp_nav_menu(array('theme_location' => 'footer', 'menu_class' => 'menu menu-column-'.count(growtype_get_menu_parent_items('footer')).'', 'menu_id' => 'footer-menu', 'walker' => new Growtype_Nav_Walker())); @endphp
                </div>
            </div>
            @if(!empty(growtype_get_footer_extra_content()))
                <div class="col-12 col-md-4">
                    <div class="footer-extra-content">
                        {!! growtype_get_footer_extra_content() !!}
                    </div>
                </div>
            @endif
        @else
            @if(!empty(growtype_get_footer_extra_content()))
                <div class="col-12">
                    <div class="footer-extra-content">
                        {!! growtype_get_footer_extra_content() !!}
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

<div class="footer-inner-bottom">
    @if(!empty(growtype_get_footer_copyright()) && get_theme_mod('footer_copyright_enabled',true))
        <div id="footer_copyright" class="copyright">
                <?php echo growtype_get_footer_copyright() ?>
        </div>
    @endif

    @include('partials.components.credits')
</div>
