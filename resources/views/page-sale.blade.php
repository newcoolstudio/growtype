@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('sidebar')
    @include('partials.content.content-sidebar-shop')
    @include('partials.content.content-sidebar-primary')
@endsection

@section('content')
    <div class="woocommerce container">
        <?php
        if (!function_exists('wc_get_products')) {
            return;
        }

        do_action('woocommerce_before_main_content');

        $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
        $ordering = WC()->query->get_catalog_ordering_args();
        $optionsArray = explode(' ', $ordering['orderby']);
        $ordering['orderby'] = array_shift($optionsArray);
        $ordering['orderby'] = stristr($ordering['orderby'], 'price') ? 'meta_value_num' : $ordering['orderby'];
        $products_per_page = apply_filters('loop_shop_per_page',
            wc_get_default_products_per_row() * wc_get_default_product_rows_per_page() + 1);

        $grouped_products = wc_get_products(array (
            'limit' => -1,
            'type' => 'grouped',
            'status' => 'publish'
        ));

        $grouped_products_on_sale = [];
        foreach ($grouped_products as $grouped_product) {
            if ($grouped_product->is_on_sale()) {
                array_push($grouped_products_on_sale, $grouped_product->get_id());
            }
        }

        $all_products_ids = get_posts(array (
            'post_type' => 'product',
            'numberposts' => -1,
            'post_status' => 'publish',
            'fields' => 'ids',
        ));

        $ids_on_sale = array_merge(wc_get_product_ids_on_sale(), $grouped_products_on_sale);

        $products = wc_get_products(array (
            'status' => 'publish',
            'limit' => $products_per_page,
            'page' => $paged,
            'paginate' => true,
            'return' => 'ids',
            'orderby' => $ordering['orderby'],
            'order' => $ordering['order'],
            'exclude' => array_diff($all_products_ids, $ids_on_sale)
        ));

        wc_set_loop_prop('current_page', $paged);
        wc_set_loop_prop('is_paginated', wc_string_to_bool(true));
        wc_set_loop_prop('page_template', get_page_template_slug());
        wc_set_loop_prop('per_page', $products_per_page);
        wc_set_loop_prop('total', $products->total);
        wc_set_loop_prop('total_pages', $products->max_num_pages);

        if ($products) {
            do_action('woocommerce_before_shop_loop');
            woocommerce_product_loop_start();
            foreach ($products->products as $product) {
                $post_object = get_post($product);
                $product = wc_get_product($product);
                setup_postdata($GLOBALS['post'] =& $post_object);
                wc_get_template_part('content', 'product');
            }
            wp_reset_postdata();
            woocommerce_product_loop_end();
            do_action('woocommerce_after_shop_loop');
        } else {
            do_action('woocommerce_no_products_found');
        }
        ?>
    </div>
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
