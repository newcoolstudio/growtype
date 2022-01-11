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
                    @while(have_posts()) @php the_post() @endphp
                    <?php
                    wc_get_template_part('content', 'product');
                    ?>
                    @endwhile
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

@section('footer')
    @include('partials.sections.footer')
@endsection
