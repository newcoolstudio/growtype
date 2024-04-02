<div class="header-logo-wrapper {!! !empty(growtype_get_header_logo_mobile()['url']) ? 'has-mobile-logo' : '' !!}">
    @if(growtype_is_home_page())
        @if(!empty(growtype_get_home_page_header_logo()['url']))
            <a id="header_logo_home" href="<?php echo growtype_get_home_url() ?>" class="mainlogo">
                <img class="img-fluid" src="{{growtype_get_home_page_header_logo()['url']}}" alt="website logo">
            </a>
        @endif
    @else
        @if(!empty(growtype_get_header_logo()['url']))
            <a id="header_logo" href="<?php echo growtype_get_home_url() ?>" class="mainlogo">
                <img class="img-fluid"
                     fetchpriority="high"
                     src="{{growtype_get_header_logo()['url']}}"
                     srcset=""
                     sizes=""
                     alt="Website logo"
                />
            </a>
        @endif
    @endif

    @if(!empty(growtype_get_header_logo_mobile()['url']))
        <a id="header_logo_mobile" href="<?php echo growtype_get_home_url() ?>" class="mainlogo mainlogo-mobile">
            <img class="img-fluid" src="{{growtype_get_header_logo_mobile()['url']}}" alt="website logo">
        </a>
    @endif

    @if(Growtype_Header::is_fixed() && !empty(growtype_get_header_logo_scroll()['url']))
        <a id="header_logo_scroll" href="<?php echo growtype_get_home_url() ?>" class="mainlogo">
            <img class="img-fluid" src="{{growtype_get_header_logo_scroll()['url']}}" alt="website logo">
        </a>
    @endif
</div>
