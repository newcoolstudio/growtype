@if(isset($post_link) && $post_link === 'false')
    <div class="b-post-single b-post-review">
        <div class="b-post-single-header">
            <div class="b-post-single-img" style="<?php echo get_featured_image_tag($post) ?>"></div>
            <p class="e-title">{{$post->post_title}}</p>
        </div>
        <div class="b-post-single-content">
            <p class="e-details">{!! $post->post_excerpt !!}</p>
        </div>
    </div>
@else
    <a href="{{get_permalink($post->ID)}}" class="b-post-single b-post-review">
        <div class="b-post-single-header">
            <div class="b-post-single-img" style="<?php echo get_featured_image_tag($post) ?>"></div>
            <p class="e-title">{{$post->post_title}}</p>
        </div>
        <div class="b-post-single-content">
            <p class="e-details">{!! $post->post_excerpt !!}</p>
            <div class="b-post-single-footer">
                <button class="btn btn-basic"><?php echo __('Read more', 'growtype') ?></button>
                <span class="e-arrow"></span>
            </div>
        </div>
    </a>
@endif
