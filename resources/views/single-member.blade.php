@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    @include('partials.content.content-single')
    @include('plugins.acf.flexible-content')
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
