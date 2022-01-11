<div class="footer-inner-top">
    @if(!empty(get_theme_mod('footer_textarea')))
        <div class="row">
            <div class="col-12">
                <div id="footer_textarea">
                    {!! get_theme_mod('footer_textarea') !!}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <a id="footer_logo" href="<?php echo get_home_url_custom() ?>" class="mainlogo">@if(!empty(get_footer_logo()['url']))
                    <img class="img-fluid" src="{{get_footer_logo()['url']}}" alt="footer_logo">@endif</a>
            <div class="c-footernav">
                @php wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu', 'walker' => new Custom_Nav_Walker())); @endphp
            </div>
        </div>
    </div>
</div>
