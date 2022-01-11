<div class="b-mainsearch">
    <div class="b-mainsearch-inner container">
        <p class="e-label">What are you Looking for?</p>

        <form role="search" method="get" id="searchform" action="{!! home_url('/') !!}">
            <input type="text" value="" name="s" id="search-form" placeholder="Search products..."/>
            <button id="searchsubmit" type="submit" value="Search">
                <i class="icon-f-85"></i>
            </button>
        </form>

        <div class="e-close">
            <a href="#" class="icon-g-80"></a>
        </div>
        <div class="b-search-results" style="display: none;">
            @if(function_exists( 'is_woocommerce_activated' ))
                <a href="{{get_permalink( woocommerce_get_page_id( 'shop' ) )}}" type="button" class="btn btn-primary">
                    <?php echo __('View all products', 'growtype') ?>
                </a>
            @endif
        </div>
    </div>
</div>
