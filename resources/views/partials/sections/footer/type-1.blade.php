<div class="footer-inner-top">
    @if(!empty(get_footer_logo()['url']))
        <div class="logo-wrapper">
            <a id="footer_logo" href="<?php echo get_home_url_custom() ?>" class="mainlogo">
                <img class="img-fluid" src="{{get_footer_logo()['url']}}" alt="footer_logo">
            </a>
        </div>
    @endif
    <div class="row">
        @if(has_nav_menu('footer'))
            <div class="col-12 col-md-8">
                <div class="c-footernav">
                    @php wp_nav_menu(array('theme_location' => 'footer', 'menu_class' => 'menu menu-column-'.count(get_menu_parent_items('footer')).'', 'menu_id' => 'footer-menu', 'walker' => new Custom_Nav_Walker())); @endphp
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div id="footer_textarea">
                    {!! get_theme_mod('footer_textarea') !!}
                </div>
            </div>
        @else
            @if(!empty(get_theme_mod('footer_textarea')))
                <div class="col-12">
                    <div id="footer_textarea">
                        {!! get_theme_mod('footer_textarea') !!}
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
<div class="footer-inner-bottom">
    @if(!empty(get_theme_mod('footer_copyright')))
        <div id="footer_copyright" class="copyright">
            <?php echo get_theme_mod('footer_copyright'); ?>
        </div>
    @endif

    @include('partials.components.social-icons')

    @include('partials.components.credits')
</div>