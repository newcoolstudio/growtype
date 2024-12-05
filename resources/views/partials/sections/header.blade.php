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
                    <?php do_action('growtype_header_inner_content'); ?>
            </div>
        </div>

            <?php do_action('growtype_header_before_close'); ?>
    </header><!-- #masthead -->
@endif

<?php do_action('growtype_header_after_close'); ?>
