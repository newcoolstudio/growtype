@if(!empty(get_post_field('post_content', get_the_ID())))
    <div class="product-extra-content product-extra-details">
        @if(get_theme_mod('woocommerce_product_page_description_section_title', true))
            <div class="b-content-intro">
                <h6 class="e-title-section">
                    <?php esc_html_e('Product details', 'growtype') ?>
                </h6>
            </div>
        @endif
        <div class="b-content-main">
            {!! apply_filters( 'the_content', get_post_field('post_content', get_the_ID()) ) !!}
        </div>
    </div>
@endif
