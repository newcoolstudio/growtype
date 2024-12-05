<div class="header-logo-wrapper {!! !empty(growtype_get_header_logo_mobile_url()) ? 'has-mobile-logo' : '' !!} {!! !empty(growtype_get_header_logo_scroll_url()) ? 'has-scroll-logo' : '' !!}">
    @if(!empty(growtype_get_header_logo_url()))
        <a id="header_logo" href="<?php echo growtype_get_home_url() ?>" class="mainlogo">
            <img class="img-fluid"
                 fetchpriority="high"
                 src="{{growtype_get_header_logo_url()}}"
                 srcset=""
                 sizes=""
                 title="<?php echo !empty(get_bloginfo('description')) ? get_bloginfo('description') : 'Website logo' ?>"
                 alt="<?php echo !empty(get_bloginfo('description')) ? get_bloginfo('description') : 'Website logo' ?>"
            />
        </a>
    @endif

    @if(!empty(growtype_get_header_logo_mobile_url()))
        <a id="header_logo_mobile" href="<?php echo growtype_get_home_url() ?>" class="mainlogo mainlogo-mobile">
            <img class="img-fluid"
                 src="{{growtype_get_header_logo_mobile_url()}}"
                 title="<?php echo !empty(get_bloginfo('description')) ? get_bloginfo('description') : 'Website logo' ?>"
                 alt="<?php echo !empty(get_bloginfo('description')) ? get_bloginfo('description') : 'Website logo' ?>"
            >
        </a>
    @endif

    @if(Growtype_Header::is_fixed())
        @if(!empty(growtype_get_header_logo_scroll_url()))
            <a id="header_logo_scroll" href="<?php echo growtype_get_home_url() ?>" class="mainlogo mainlogo-scroll">
                <img class="img-fluid"
                     src="{{growtype_get_header_logo_scroll_url()}}"
                     title="<?php echo !empty(get_bloginfo('description')) ? get_bloginfo('description') : 'Website logo' ?>"
                     alt="<?php echo !empty(get_bloginfo('description')) ? get_bloginfo('description') : 'Website logo' ?>"
                >
            </a>
        @endif
        @if(!empty(growtype_get_header_logo_mobile_scroll_url()))
            <a id="header_logo_mobile_scroll" href="<?php echo growtype_get_home_url() ?>" class="mainlogo mainlogo-mobile-scroll">
                <img class="img-fluid"
                     src="{{growtype_get_header_logo_mobile_scroll_url()}}"
                     title="<?php echo !empty(get_bloginfo('description')) ? get_bloginfo('description') : 'Website logo' ?>"
                     alt="<?php echo !empty(get_bloginfo('description')) ? get_bloginfo('description') : 'Website logo' ?>"
                >
            </a>
        @endif
    @endif
</div>
