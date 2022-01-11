<a href="{{get_permalink($post->ID)}}" class="b-post-single b-post-arrow">
    <div class="b-post-single-img" style="<?php echo get_featured_image_tag($post) ?>"></div>
    <div class="b-post-single-content">
        <p class="e-title">{{$post->post_title}}</p>
        <p class="e-details">{{get_post_content_limited($post->post_excerpt)}}</p>
        <div class="b-post-single-footer">
            <button class="btn btn-basic"><?php echo __('Read more', 'growtype') ?></button>
            <span class="e-arrow"></span>
        </div>
    </div>
</a>
