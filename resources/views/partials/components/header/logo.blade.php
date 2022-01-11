<div class="header-logo-wrapper">
    @if(is_front_page())
        @if(!empty(get_header_logo_home()['url']))
            <a id="header_logo_home" href="<?php echo get_home_url_custom() ?>" class="mainlogo">
                <img class="img-fluid" src="{{get_header_logo_home()['url']}}" alt="header_logo">
            </a>
        @endif
    @else
        @if(!empty(get_header_logo()['url']))
            <a id="header_logo" href="<?php echo get_home_url_custom() ?>" class="mainlogo">
                <img class="img-fluid" src="{{get_header_logo()['url']}}" alt="header_logo">
            </a>
        @endif
    @endif

    @if(header_is_fixed() && !empty(get_header_logo_scroll()['url']))
        <a id="header_logo_scroll" href="<?php echo get_home_url_custom() ?>" class="mainlogo">
            <img class="img-fluid" src="{{get_header_logo_scroll()['url']}}" alt="header_logo">
        </a>
    @endif
</div>
