<div class="b-member-single b-member-single-vertical" data-content="{!! empty($post->post_excerpt) ? '0' : '1' !!}">
    <div class="b-member-single-inner">
        <div class="b-mainimg-wrapper">
            <div class="b-mainimg" style="<?php echo get_featured_image_tag($post, 'full',
                'background-position: top;background-size: cover;') ?>"></div>
        </div>
        <div class="b-content">
            @if(!empty($post->post_excerpt))
                <p class="e-title-cat">{{$post->post_excerpt}}</p>
            @endif
            <p class="e-title">{{$post->post_title}}</p>
            <div class="e-details">
                @if(class_exists('ACF') && get_field('preview_content_visible'))
                    {!! apply_filters( 'the_content', $post->post_content ) !!}
                @endif
                @include('plugins.acf.contacts.basic')
            </div>
        </div>
    </div>
</div>
