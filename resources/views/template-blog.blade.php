{{--
  Template Name: Template - Blog
  Template Post Type: page, post
--}}

@extends('layouts.app')

@section('header')
    @include('partials.sections.header')
@endsection

@section('content')
    <section class="s-intro">
        <?php
        $wpb_all_query = new WP_Query(array (
            'post_type' => 'post',
            'post_status' => 'publish',
            'category_name' => 'featured',
            'posts_per_page' => 1
        )); ?>

        <?php if ($wpb_all_query->have_posts()) : ?>
        <?php while ($wpb_all_query->have_posts()) : $wpb_all_query->the_post(); ?>
        <div class="b-intro">
            <div class="col-12 col-lg-6 px-0 b-maincontent">
                <div class="b-intro-content">
                    <h1 class="e-title display-4">
                        <a href="{{ the_permalink() }}" class="text-decoration-none">{!! the_title() !!}</a>
                    </h1>
                    <div class="b-text">
                        <a href="{{ the_permalink() }}" class="text-decoration-none">
                            {!! strip_tags( get_the_excerpt() ) !!}
                        </a>
                    </div>
                    <div class="b-datetime">
                        <p class="e-time">{{ get_post_reading_time(get_post()) }}</p>
                        <span class="e-dot">•</span>
                        <p class="e-date">{{ get_the_date() }}</p>
                    </div>
                    <div class="b-actions">
                        <a href="{{ the_permalink() }}" class="btn btn-primary btn-block"><?php echo __('Read more',
                                'growtype')?></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 px-0 b-img" style="{{get_featured_image_tag(get_post())}}"></div>
        </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </section>

    <section class="s-maincontent pt-3 pb-4" style="background: #F8F9FB;">
        <div class="container">
            <?php
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            $loop = new WP_Query(array (
                    'post_type' => 'post',
                    'posts_per_page' => 9,
                    'paged' => $paged
                )
            );
            if ( $loop->have_posts() ):
            ?>

            <h3 class="e-title-section pt-5 pb-4 m-0">
                <?php echo __('Latest articles',
                    'growtype')?>
            </h3>

            <div class="blog-posts pt-3">

                <?php
                while ( $loop->have_posts() ) : $loop->the_post(); ?>

                @include('partials.content.post.preview.arrow')

                <?php endwhile; ?>
            </div>

            <nav class="pagination pagination-posts mt-3 pt-4 pb-5">
                <?php get_posts_pagination($loop); ?>
            </nav>

            <?php wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <section class="s-extra">
        @include('partials.content.content-page')
    </section>
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection