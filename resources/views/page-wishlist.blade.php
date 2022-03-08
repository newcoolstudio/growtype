@extends('layouts.app', ['body_class' => class_exists('woocommerce') ? 'woocommerce' : null])

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    @include('partials.sections.content')
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
