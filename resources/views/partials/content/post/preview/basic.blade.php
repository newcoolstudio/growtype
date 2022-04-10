@php
    $post = isset($post) ? $post : get_post();
@endphp

@if(isset($link_to_inner_post) && $link_to_inner_post === false)
    <div class="b-post-single {!! $parent_class ?? null !!}">
        @else
            <a href="{{get_permalink($post->ID)}}" class="b-post-single {!! $parent_class ?? null !!}">
                @endif
                <div class="b-post-single-inner">
                    @if(!empty(get_featured_image_tag($post, 'medium')))
                        <div class="e-img" style="<?php echo get_featured_image_tag($post, 'medium') ?>"></div>
                    @endif
                    <div class="b-content">
                        <p class="e-date">{!! get_the_date() !!}</p>
                        @if(!empty($post->post_title))
                            <h4>{!! $post->post_title !!}</h4>
                        @endif
                        @if(!empty($post->post_excerpt))
                            <p>{{$post->post_excerpt}}</p>
                        @endif
                        <div class="e-intro">
                            @if(isset($content_length) && $content_length === -1)
                                {!! $post->post_content !!}
                            @else
                                {{Growtype_Post::content_limited($post->post_content, isset($content_length) ? $content_length : 200)}}
                            @endif
                        </div>
                    </div>
                    <div class="read-more">
                        <button class="btn read-more-link color-primary btn-basic">
                            <?php echo __('Continue reading', 'growtype') . '...'; ?>
                        </button>
                    </div>
                </div>
            @if(isset($link_to_inner_post) && $link_to_inner_post === false)
    </div>
    @else
    </a>
@endif


