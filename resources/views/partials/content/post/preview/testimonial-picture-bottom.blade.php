<div class="b-testimonial b-testimonial-picture-bottom">
    <div class="b-testimonial-content">
        <div class="e-quate">"</div>
        <?php echo $testimonial->post_content ?>
    </div>
    <div class="b-testimonial-avatar">
        <div class="b-testimonial-avatar-image" style="<?php echo get_featured_image_tag($testimonial) ?>"></div>
        <div class="b-testimonial-avatar-description">
            <p class="b-testimonial-avatar-title">{{$testimonial->post_title}}</p>
            @if(!empty($tax))
                <p class="b-testimonial-avatar-position">{{$tax->name}}</p>
            @endif
        </div>
    </div>
</div>
