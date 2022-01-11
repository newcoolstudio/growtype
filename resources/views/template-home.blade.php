{{--
  Template Name: Template - Home
  Template Post Type: page, post, member, activity, office
--}}

@extends('layouts.app')

@section('header')
    @include('partials.sections.header')
@endsection

@section('content')
    @include('partials.content.content-page')
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
