@if(header_is_enabled())
  <header id="masthead"
          class="site-header"
          role="banner"
  >

    @if(Growtype_Header::has_promo())
      <div class="b-promo">
        <div class="container">
          <div class="b-promo-text">
            {!! Growtype_Header::promo_content() !!}
          </div>
        </div>
      </div>
    @endif

    @if(get_theme_mod('header_navbar_switch'))
      <div class="b-navbar">
        <div class="container">
          <div id="header_navbar_text" class="e-text">{!! get_theme_mod('header_navbar_text') !!}</div>
          @include('partials.components.social-icons')
        </div>
      </div>
    @endif

    <div class="container">
      <div class="header-inner">
        @if(get_theme_mod('header_mobile_menu_position') === 'left')
          @if(!get_theme_mod('mobile_menu_disabled'))
            @include('partials.components.hamburger')
          @endif
        @endif

        @include('partials.components.header.logo')

        {!! Growtype_Page::title_render() !!}

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

        @if(Growtype_User::profile_menu_is_enabled())
          @include('partials.components.user-profile')
        @endif

        @if (Growtype_Language::selector())
          <li class="language-selector <?php echo Growtype_Language::selector_classes() ?>">
              <?php echo qtranxf_generateLanguageSelectCode('text') ?>
          </li>
        @endif

        @if(empty(get_theme_mod('header_mobile_menu_position')) || get_theme_mod('header_mobile_menu_position') === 'right')
          @if(!get_theme_mod('mobile_menu_disabled'))
            @include('partials.components.hamburger')
          @endif
        @endif
      </div>
    </div>

    @if(class_exists( 'woocommerce' ) && cart_page_icon_is_active())
      @include('partials.components.woocommerce-cart')
    @endif
  </header><!-- #masthead -->
@endif

