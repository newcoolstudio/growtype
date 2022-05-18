<div class="b-testimonial b-testimonial-picture-top">
    <div class="b-testimonial-inner">
        <div class="b-testimonial-header">
            <div class="e-quate">“</div>
            <div class="b-testimonial-avatar">
                <div class="b-testimonial-avatar-image" style="<?php echo get_featured_image_tag($testimonial) ?>"></div>
            </div>
        </div>
        <div class="b-testimonial-content">
            <?php echo $testimonial->post_content ?>
        </div>
        <div class="b-testimonial-footer">
            <p class="b-testimonial-avatar-title">{{$testimonial->post_title}}</p>
            <p class="b-testimonial-avatar-subtitle">{{$testimonial->post_excerpt}}</p>

            @if(!empty($tax))
                <p class="b-testimonial-avatar-position">{{$tax->name}}</p>
            @endif
        </div>
    </div>
</div>
