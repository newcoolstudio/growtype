@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    @include('partials.content.content-single')
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
