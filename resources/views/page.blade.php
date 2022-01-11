@extends('layouts.app')

@section('header')
    @include('partials.sections.header')
@endsection

@section('content')
    @include('partials.content.content-page')
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
