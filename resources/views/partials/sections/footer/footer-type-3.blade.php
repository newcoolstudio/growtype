<div class="footer-inner-top">
    <div class="row">
        <div class="col-12 col-md-5 col-xl-7">
            <div class="c-footernav">
                @php wp_nav_menu(array('theme_location' => 'footer', 'menu_class' => 'menu menu-column-'.count(get_menu_parent_items('footer')).'', 'menu_id' => 'footer-menu', 'walker' => new Custom_Nav_Walker())); @endphp
            </div>
        </div>
        <div class="col-12 col-md-7 col-xl-5">
            <div id="footer_textarea">
                {!! get_theme_mod('footer_textarea') !!}
            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-12 text-center">
            @include('partials.components.social-icons')
            <a id="footer_logo" href="<?php echo get_home_url_custom() ?>" class="mainlogo mx-auto">
                @if(!empty(get_footer_logo()['url']))
                    <img class="img-fluid" src="{{get_footer_logo()['url']}}" style="padding-top: 0;" alt="footer_logo">
                @endif
            </a>
        </div>
    </div>
</div>
