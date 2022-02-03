<table class="table">

    @include('woocommerce.components.table.product-table-head')

    <tbody>
    <?php
    if (!isset($products)) {
        global $wp_query;
        $products = $wp_query;
    }

    while ($products->have_posts()) : $products->the_post();
    /**
     * Hook: woocommerce_shop_loop.
     */
    do_action('woocommerce_shop_loop');
    ?>

    @include('woocommerce.components.table.product-table-row')

    <?php endwhile; ?>

    </tbody>
</table>
