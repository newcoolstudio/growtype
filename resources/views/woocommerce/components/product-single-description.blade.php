@if(!empty(get_post_field('post_content', get_the_ID())))
    <div class="b-product-description">
        @if(get_theme_mod('woocommerce_product_page_description_section_title'))
            <h3 class="e-title-section mb-3">
                <?php esc_html_e('Description','growtype') ?>
            </h3>
        @endif
        {!! apply_filters( 'the_content', get_post_field('post_content', get_the_ID()) ) !!}
    </div>
@endif
