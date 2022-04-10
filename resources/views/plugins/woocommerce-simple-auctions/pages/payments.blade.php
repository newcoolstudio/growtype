@extends('layouts.app')

@section('header')
    @include('partials.sections.header')
@endsection

@section('content')
    <div class="content-wrapper {!! $section_class ?? null !!}">
        <div class="container">
            <div class="content">
                @if(!empty($order))
                    <p>orders list</p>
                @else
                    <p>You have no orders</p>
                @endif
            </div>
        </div>
    </div>
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
