<?php do_action('growtype_header_before_open'); ?>

@if(growtype_header_is_enabled())
    <header id="masthead"
            class="site-header"
            role="banner"
    >
            <?php do_action('growtype_header_after_open'); ?>

        @if(Growtype_Header::has_promo())
            <div class="b-promo">
                <div class="container">
                    <div class="b-promo-text">
                        {!! Growtype_Header::promo_content() !!}
                    </div>
                </div>
            </div>
        @endif

            <?php do_action('growtype_navbar_html'); ?>

        <div class="container">
            <div class="header-inner">
                    <?php do_action('growtype_header_inner_after_open'); ?>

                @include('partials.components.logo.header')

                {!! Growtype_Page::title_render() !!}

                @if(!empty(get_theme_mod('header_extra_content')))
                    <div class="header-extra-content-wrapper">
                        {!! apply_filters( 'the_content', get_theme_mod('header_extra_content') ) !!}
                    </div>
                @endif

                @if(growtype_header_main_menu_is_enabled())
                    @include('partials.components.menu.main')
                @endif

                @if(growtype_header_mobile_menu_is_enabled())
                    @include('partials.components.menu.mobile')
                @endif

                @include('partials.components.menu.side')

                @if(growtype_header_login_menu_is_enabled())
                    @include('partials.components.menu.login')
                @endif

                    <?php do_action('growtype_header_inner_before_close'); ?>
            </div>
        </div>

            <?php do_action('growtype_header_before_close'); ?>
    </header><!-- #masthead -->
@endif

<?php do_action('growtype_header_after_close'); ?>
