<div class="b-preview-wrapper">
    <a href="{!! get_permalink($post) !!}" class="b-preview b-service" style="<?php echo get_featured_image_tag($post) ?>">
        <div class="b-preview-inner">
            <div class="b-preview-content">
                <p class="e-title">{{$post->post_title}}</p>
            </div>
        </div>
    </a>
</div>
