{{--
  Template Name: Template - Blog
  Template Post Type: page, post
--}}

@extends('layouts.app')

@section('header')
    @include('partials.sections.header')
@endsection

@section('content')

    <?php
    $wpb_all_query = new WP_Query(array (
        'post_type' => 'post',
        'post_status' => 'publish',
        'category_name' => 'featured',
        'posts_per_page' => 1
    )); ?>

    <?php if ($wpb_all_query->have_posts()) : ?>
    <section class="s-mainintro">
        <?php while ($wpb_all_query->have_posts()) : $wpb_all_query->the_post(); ?>
        <div class="b-intro">
            <div class="col-12 col-lg-6 px-0 b-maincontent">
                <div class="b-intro-content">
                    <h1 class="e-title display-4">
                        <a href="<?php echo the_permalink() ?>" class="text-decoration-none"><?php the_title() ?></a>
                    </h1>
                    <div class="b-text">
                        <a href="<?php echo the_permalink() ?>" class="text-decoration-none">
                            <?php echo strip_tags(get_the_excerpt()) ?>
                        </a>
                    </div>
                    <div class="b-datetime">
                        <?php if(class_exists('Growtype_Page')){ ?>
                        <p class="e-time"><?php Growtype_Page::reading_time(get_the_ID()) ?></p>
                        <?php } ?>
                        <span class="e-dot">•</span>
                        <p class="e-date"><?php get_the_date() ?></p>
                    </div>
                    <div class="b-actions">
                        <a href="<?php the_permalink() ?>" class="btn btn-primary btn-block">
                            <?php echo __('Read more', 'growtype')?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 px-0 b-img" style="<?php get_featured_image_tag(get_post()) ?>"></div>
        </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </section>
    <?php endif; ?>

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

    <section class="s-maincontent">
        <div class="container">

            <h3 class="e-title-section">
                <?php echo __('Latest articles', 'growtype')?>
            </h3>

            <div class="blog-posts">

                <?php
                while ( $loop->have_posts() ) : $loop->the_post(); ?>

                @include('partials.content.post.preview.blog')

                <?php endwhile; ?>
            </div>

            <?php if(class_exists('Growtype_Page')){ ?>
            <nav class="pagination pagination-posts">
                <?php echo Growtype_Page::pagination($loop) ?>
            </nav>
            <?php } ?>

            <?php wp_reset_postdata();?>
        </div>
    </section>
    <?php
    endif;
    ?>

    <section class="s-extra">
        @include('partials.content.content-page')
    </section>
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
