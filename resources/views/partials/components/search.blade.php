<div class="search-main search-{!! get_theme_mod('search_style') !!}">
    <div class="search-main-inner container">
        <p class="e-label"><?php echo __('What are you Looking for?', 'growtype') ?></p>

        <form role="search" method="get" id="searchform" action="{!! Growtype_Post::permalink() !!}">
            <input type="text" value="" name="s" id="search-form" placeholder="Search products..."/>
            <button class="btn btn-primary" id="searchsubmit" type="submit" value="Search">
                <i class="icon-search"></i>
            </button>
        </form>

        @if(get_theme_mod('search_style') === 'fixed')
            <div class="btn btn-close"></div>
        @endif

        <div class="b-search-results" style="display: none;">
            @if(function_exists( 'is_woocommerce_activated' ))
                <a href="{{get_permalink( wc_get_page_id( 'shop' ) )}}" type="button" class="btn btn-primary">
                    <?php echo __('View all products', 'growtype') ?>
                </a>
            @endif
        </div>
    </div>
</div>
