@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <?php do_action('growtype_archive'); ?>

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

