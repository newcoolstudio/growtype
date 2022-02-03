@php
    $post = isset($post) ? $post : get_post();
@endphp

<a href="{{get_permalink($post->ID)}}" class="b-post-single {!! $parent_class ?? null !!}">
    <div class="b-post-single-inner">
        <div class="e-img" style="<?php echo get_featured_image_tag($post, 'medium') ?>"></div>
        <div class="b-content">
            <p class="e-date">{!! get_the_date() !!}</p>
            <h4>{!! $post->post_title !!}</h4>
            <p>{{$post->post_excerpt}}</p>
            <div class="e-intro">
                {{Growtype_Post::content_limited($post->post_content)}}
            </div>
        </div>
        <div class="read-more">
            <button class="btn read-more-link color-primary btn-basic"><?php echo __('Continue reading',
                        'growtype') . '...'; ?></button>
        </div>
    </div>
</a>
