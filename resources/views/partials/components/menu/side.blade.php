@if(class_exists('WOOMULTI_CURRENCY_F') ||
has_nav_menu('header-side') ||
get_theme_mod('search_icon_enabled') ||
Growtype_User::account_icon_enabled() ||
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
                'menu_class' => 'menu nav',
                'walker' => new Growtype_Nav_Walker()
            ));
        }
        ?>

        <div class="menu customizer">
            @if(get_theme_mod('search_icon_enabled'))
                <li class="e-search">
                    <i class="icon-search"></i>
                </li>
            @endif

            @if(Growtype_User::account_icon_enabled())
                <li class="e-profile">
                    <a href="{!! Growtype_User::account_permalink() !!}">
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
            if (cart_page_icon_is_active()) { ?>
            <li class="e-cart">
                <i class="icon-cart"></i>
            </li>
            <?php } ?>
        </div>
    </div>
@endif
