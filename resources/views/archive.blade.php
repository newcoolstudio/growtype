@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <?php
            if (function_exists('growtype_post_render_all')) {
                echo growtype_post_render_all(get_posts(), [
                    'preview_style' => 'basic',
                    'columns' => 3,
                    'post_link' => true
                ]);
            }
            ?>

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

