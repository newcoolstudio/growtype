{{--
  Template Name: Template - Intro Half Offgrid
  Template Post Type: page, post, member, activity, office
--}}

@extends('layouts.app')

@section('header')
    @include('partials.sections.header')
@endsection

@section('content')
    @include('partials.sections.intro.half-offgrid')
    @include('plugins.acf.flexible-content')
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
