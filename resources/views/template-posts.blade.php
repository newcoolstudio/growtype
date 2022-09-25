{{--
  Template Name: Template - Posts
  Template Post Type: page, post, member, activity, office
--}}

@extends('layouts.app')

@section('header')
    @include('partials.sections.header')
@endsection

@section('content')
    <div class="container">
        @if(!empty(get_the_title()))
            <h2 class="e-title-intro">
                {!! get_the_title() !!}
            </h2>
        @endif

        @include('partials.content.content-page')
    </div>
    <div class="s-posts">
        <div class="container">
            <div class="b-posts">
                <div class="b-posts-inner row">
                    <?php
                    // set the "paged" parameter (use 'page' if the query is on a static front page)
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : '1';
                    $args = array (
                        'nopaging' => false,
                        'paged' => $paged,
                        'posts_per_page' => '6',
                        'post_type' => 'post',
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    );

                    // The Query
                    $query = new WP_Query($args);

                    // The Loop
                    if ($query->have_posts() && function_exists('growtype_post_render_all')) {
                        echo growtype_post_render_all($posts->get_posts(), 'basic', 3, true);
                    }
                    ?>
                </div>
            </div>

            <nav class="pagination pagination-posts mt-3 pt-4 pb-5">
                {!! Growtype_Page::pagination($query); !!}
            </nav>
            <?php

            } else {
                // no posts found
                echo '<h1 class="page-title screen-reader-text">No Posts Found</h1>';
            }

            // Restore original Post Data
            wp_reset_postdata();
            ?>

        </div>
    </div>

    @include('plugins.acf.flexible-content')
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
