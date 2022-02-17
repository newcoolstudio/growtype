@if(class_exists('ACF'))
    @if (have_rows('flexible_block'))
        @while(have_rows('flexible_block')) @php the_row() @endphp

        @if (get_row_layout() == 'photo_title_content_block')

            @include('plugins.acf.flexible-content.photo-title-content-block')

        @elseif (get_row_layout() == 'intro_section')

            @include('plugins.acf.flexible-content.intro-section')

        @elseif (get_row_layout() == 'main_gallery')

            @include('plugins.acf.flexible-content.main-gallery')

        @elseif (class_exists( 'woocommerce' ) && get_row_layout() == 'featured_product_categories')

            @include('plugins.acf.flexible-content.featured-product-categories')

        @elseif (class_exists( 'woocommerce' ) && get_row_layout() == 'featured_products')

            @include('plugins.acf.flexible-content.featured-products')

        @elseif (get_row_layout() == 'featured_posts')

            @include('plugins.acf.flexible-content.featured-posts')

        @elseif (get_row_layout() == 'featured_offices')

            @include('plugins.acf.flexible-content.featured-offices')

        @elseif (get_row_layout() == 'featured_activities')

            @include('plugins.acf.flexible-content.featured-activities')

        @elseif (get_row_layout() == 'featured_projects')

            @include('plugins.acf.flexible-content.featured-projects')

        @elseif (get_row_layout() == 'featured_member')

            @include('plugins.acf.flexible-content.featured-member')

        @elseif (get_row_layout() == 'featured_cpt')

            @include('plugins.acf.flexible-content.featured-cpt')

        @elseif (get_row_layout() == 'contact_details')

            @include('plugins.acf.flexible-content.contact-details')

        @elseif (get_row_layout() == 'tab_accordion')

            @include('plugins.acf.flexible-content.tab-accordion')

        @elseif (get_row_layout() == 'shortcode')

            @include('plugins.acf.flexible-content.shortcode')

        @elseif (get_row_layout() == 'testimonials')

            @include('plugins.acf.flexible-content.testimonials')

        @elseif (get_row_layout() == 'photo_slider')

            @include('plugins.acf.flexible-content.photo-slider')

        @elseif (get_row_layout() == 'interactive_map')

            @include('plugins.acf.flexible-content.interactive-map')

        @elseif (get_row_layout() == 'featured_benefits')

            @include('plugins.acf.flexible-content.featured-benefits')

        @endif

        @endwhile
    @endif
@endif

