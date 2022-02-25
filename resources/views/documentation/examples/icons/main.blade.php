@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('sidebar')
    @include('partials.content.content-sidebar-primary')
@endsection

@section('content')
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
