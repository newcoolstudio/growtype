<div class="b-cpt {!! $block_style ?? null !!}" data-cat="{!! $post_cat ?? null !!}">
    <div class="b-cpt-inner" data-slides-to-show="{{$slides_to_show ?? null}}" data-slides-existing-amount="{!! isset($posts_to_display) ? count($posts_to_display) : '' !!}">
        @if(!empty(get_featured_image($post)))
            <div class="b-cpt-img">
                <img class="img-fluid" src="{!! get_featured_image($post) !!}" alt="">
            </div>
        @endif
        <div class="b-maincontent">
            @if(!empty($post->post_title))
                <p class="b-cpt-title">
                    {!! $post->post_title !!}
                </p>
            @endif
            @if(!empty($post->post_excerpt))
                <p class="b-cpt-subtitle">
                    {!! $post->post_excerpt !!}
                </p>
            @endif
            @if(!empty($post->post_content))
                <div class="b-cpt-content">
                    {!! apply_filters( 'the_content', $post->post_content ) !!}
                </div>
            @endif
        </div>
    </div>
</div>
