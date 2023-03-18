{{--
  Template Name: Template - Intro Full
  Template Post Type: page, post, member, activity, office
--}}

@extends('layouts.app')

@section('header')
    @include('partials.sections.header')
@endsection

@section('content')
    @include('partials.sections.intro.full')
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
