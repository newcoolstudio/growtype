@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('sidebar')
    @include('partials.content.content-sidebar-primary')
@endsection

@section('content')
    <p>Include icons here</p>
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
