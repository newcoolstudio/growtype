@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    @if (!have_posts() || empty(get_search_query()))
        <div class="container text-center mt-5 mb-5">
            <h3>{{ __('Sorry, no results were found.', 'growtype') }}</h3>
            <p>{{ __("But don't give up – check the spelling or try less specific search terms.", "growtype") }}</p>
        </div>
    @endif
    @if (!empty(get_search_query()))
        @if(get_post_type() === 'product')
            <div class="container">
                <div class="woocommerce b-products">
                    <?php wc_get_template('loop/loop-start.php'); ?>

                    @if(Growtype_Product::catalog_default_preview_style() === 'table')
                        @include('woocommerce.components.table.product-table')
                    @else
                        @while(have_posts()) @php the_post() @endphp
                        <?php
                        wc_get_template_part('content', 'product');
                        ?>
                        @endwhile
                    @endif

                    <?php wc_get_template('loop/loop-end.php'); ?>
                </div>
            </div>
        @else
            <div class="container">
                @while(have_posts()) @php the_post() @endphp
                @include('partials.content.content-search')
                @endwhile
            </div>
        @endif
    @endif
@endsection

@section('panel')
    @include('partials.content.content-panel')
@endsection

@section('sidebar')
    @include('partials.content.content-sidebar-primary')
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
