<table class="table">

    @include('woocommerce.components.table.product-table-head')

    <tbody>
    <?php
    while (have_posts()) {
    the_post();

    /**
     * Hook: woocommerce_shop_loop.
     */
    do_action('woocommerce_shop_loop');

    ?>

    @include('woocommerce.components.table.product-table-row')

    <?php
    }
    ?>
    </tbody>
</table>
