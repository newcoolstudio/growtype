@if(header_is_enabled())
    <header id="masthead"
            class="site-header"
            role="banner"
    >

        @if(get_theme_mod('header_navbar_switch'))
            <div class="b-navbar">
                <div class="container">
                    <div id="header_navbar_text" class="e-text">{!! get_theme_mod('header_navbar_text') !!}</div>
                    @include('partials.components.social-icons')
                </div>
            </div>
        @endif

        <div class="container header-inner">
            @include('partials.components.header.logo')

            @include('partials.components.header.extra')

            @if(header_main_menu_is_enabled())
                @include('partials.components.header.menu-main')
            @endif

            @if(header_mobile_menu_is_enabled())
                @include('partials.components.header.menu-mobile')
            @endif

            @include('partials.components.header.menu-side')

            @if(header_login_menu_is_enabled())
                @include('partials.components.header.menu-login')
            @endif

            @if(growtype_user_profile_menu_is_enabled())
                @include('partials.components.user-profile')
            @endif

            @if(get_theme_mod('search_icon_enabled'))
                @include('partials.components.search')
            @endif

            @if(!get_theme_mod('mobile_menu_disabled'))
                <button class="hamburger hamburger--squeeze is-pasive" type="button">
                    <div class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </div>
                </button>
            @endif
        </div>

        @if(class_exists( 'woocommerce' ) && cart_page_icon_is_active())
            @include('partials.components.woocommerce-cart')
        @endif

    </header><!-- #masthead -->
@endif

