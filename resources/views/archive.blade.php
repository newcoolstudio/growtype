@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-md-4">
                @php($post = get_post())
                @include('partials.content.post.preview.basic')
            </div>
            <?php endwhile; // end of the loop. ?>

            <?php
            wp_link_pages(
                array (
                    'before' => '<div class="page-link"><span>' . __('Pages:', 'growtype') . '</span>',
                    'after' => '</div>',
                )
            );
            ?>
        </div>
    </div>
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection

@section('footerScripts')
@endsection

