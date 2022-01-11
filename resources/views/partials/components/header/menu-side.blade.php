@if(class_exists('WOOMULTI_CURRENCY_F') ||
has_nav_menu('header-side') ||
get_theme_mod('search_icon_enabled') ||
user_account_icon_enabled() ||
wishlist_page_icon() ||
cart_page_icon_is_active())
    <div class="side-nav-wrapper">
        <?php
        if (class_exists('WOOMULTI_CURRENCY_F')) {
            echo do_shortcode('[woo_multi_currency_plain_vertical]');
        }
        ?>

        <?php
        if (has_nav_menu('header-side')) {
            wp_nav_menu(array (
                'theme_location' => 'header-side',
                'container_class' => 'side-nav',
                'menu_id' => 'header-side-menu',
                'menu_class' => 'menu nav'
            ));
        }
        ?>

        <div class="menu customizer">
            @if(get_theme_mod('search_icon_enabled'))
                <li class="e-search">
                    <i class="icon-f-85"></i>
                </li>
            @endif

            @if(user_account_icon_enabled())
                <li class="e-profile">
                    <a href="{!! wc_get_page_permalink( 'myaccount' ) !!}">
                        <i class="icon-f-94"></i>
                    </a>
                </li>
            @endif

            <?php
            if (wishlist_page_icon()) { ?>
            <li class="e-wishlist">
                <a href="{!! get_permalink( get_page_by_path( 'wishlist' ) ) !!}">
                    <i class="icon-n-072"></i>
                </a>
            </li>
            <?php } ?>

            <?php
            if (cart_page_icon_is_active()) { ?>
            <li class="e-cart">
                <i class="icon-f-39"></i>
            </li>
            <?php } ?>
        </div>
    </div>
@endif
