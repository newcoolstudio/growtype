<div id="site-navigation-mobile" class="main-navigation-mobile main-navigation-mobile-{{get_theme_mod('header_mobile_menu_style')}}" role="navigation">
    <div class="main-navigation-mobile-inner">

        <div class="main-navigation-mobile-top">
            @if(!empty(get_mobile_burger_logo()))
                <div class="header-logo-wrapper">
                    <div id="mobile_burger_logo" class="mainlogo">
                        <img class="img-fluid" src="{{get_mobile_burger_logo()['url']}}" alt="header_mobile_logo">
                    </div>
                </div>
            @endif

            @include('partials.components.hamburger')
        </div>

        <div class="main-navigation-mobile-content">
            <?php
            if (has_nav_menu('mobile')) {
                wp_nav_menu([
                    'theme_location' => 'mobile',
                    'container_class' => 'menu-mobile-container',
                    'menu_id' => 'mobile-menu',
                    'menu_class' => 'menu nav'
                ]);
            }
            ?>

            @if(header_login_menu_is_enabled())
                @include('partials.components.header.menu-login')
            @endif

            <div class="menu menu-extra">
                @if(Growtype_User::account_icon_enabled())
                    <li class="e-profile">
                        <a href="{!! wc_get_page_permalink( 'myaccount' ) !!}">
                            <i class="icon-profile"></i>
                        </a>
                    </li>
                @endif

                <?php
                if (wishlist_page_icon()) { ?>
                <li class="e-wishlist">
                    <a href="{!! get_permalink( get_page_by_path( 'wishlist' ) ) !!}">
                        <i class="icon-wishlist"></i>
                    </a>
                </li>
                <?php } ?>

                <?php
                if (Growtype_Language::selector()) { ?>
                <li class="language-selector">
                    <?php echo qtranxf_generateLanguageSelectCode('text')?>
                </li>
                <?php } ?>

                <?php
                if (class_exists('WOOMULTI_CURRENCY_F')) { ?>
                <li class="currency-selector">
                    <span><?php echo __('Currency', 'growtype') ?></span>
                    {!! do_shortcode('[woo_multi_currency_plain_vertical]') !!}
                </li>
                <?php } ?>

            </div>

        </div>

    </div>
</div>
