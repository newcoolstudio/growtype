@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    <article>
        <?php do_action('growtype_single_post_back'); ?>
        <?php do_action('growtype_single_post_title'); ?>
        <?php do_action('growtype_single_post_taxonomy'); ?>
        <?php do_action('growtype_single_post_reading_time'); ?>
        <?php do_action('growtype_single_post_date'); ?>
        <?php do_action('growtype_single_post_featured_image'); ?>
        <?php do_action('growtype_single_post_cta'); ?>
        @include('partials.content.content-single')
        @php(comments_template())
        <?php do_action('growtype_single_post_before_close'); ?>
    </article>
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
