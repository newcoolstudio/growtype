@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

<?php
$start_date = $start_date ?? get_field('start_date');
$end_date = $end_date ?? get_field('end_date');
$expiration_date = !empty($end_date) ? $end_date : $start_date;
$registration_url = $registration_url ?? get_field('registration_url');
?>

@section('content')
    <section class="s-mainintro" style="background: #F4F4F4;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-8 px-0 b-intro" style="{{get_featured_image_tag(get_post())}}">
                    <div class="b-intro-content">
                        <h1 class="e-title display-4">
                            {!! the_title() !!}
                        </h1>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="b-details">
                        <h3 class="e-title"><?php echo __('Event details', 'growtype')?></h3>
                        <div class="e-detail" data-type="date">
                            <div class="e-label"><span class="dashicons dashicons-clock"></span> <?php echo __('Date',
                                    'growtype')?></div>
                            <div class="e-value">
                                {{date_i18n('Y-m-d H:i', strtotime($start_date))}}
                                @if(!empty($end_date))
                                    -
                                    {{date_i18n('Y-m-d H:i', strtotime($end_date))}}
                                @endif
                            </div>
                        </div>
                        <div class="e-detail" data-type="location">
                            <div class="e-label"><span class="dashicons dashicons-location"></span> <?php echo __('Location',
                                    'growtype')?></div>
                            <div class="e-value">
                                {{get_post_meta(get_the_ID(), 'activity_location', true)}}
                            </div>
                        </div>
                        @if(!empty($registration_url))
                            <div class="b-actions {!! strtotime($expiration_date) < strtotime(date('Y-m-d H:i:s')) ? 'is-expired' : '' !!}">
                                <a href="{!! $registration_url !!}" class="btn btn-primary btn-block" target="_blank">
                                    <?php echo __('Register', 'growtype') ?>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="s-maincontent pt-5 pb-5">
        <div class="container">
            <div class="row flex-column-reverse flex-xl-row">
                <div class="col-12">
                    {!! the_content() !!}
                </div>
            </div>
        </div>
    </section>

    <section class="pt-4 pb-5 mb-0 b-relatedarticles">
        <div class="container">
            <div class="row">
                <div class="col-md-12 blog-main">
                    <h3 class="e-title-section"><?php echo __('Related events', 'growtype')?></h3>
                    <div class="row blog-posts">
                        @php
                            $relatedPostsToDisplay = Growtype_Post::ordered_by_start_time(3, get_the_id());
                        @endphp

                        @foreach($relatedPostsToDisplay as $post)
                            @include('partials.content.activity.preview.basic')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
