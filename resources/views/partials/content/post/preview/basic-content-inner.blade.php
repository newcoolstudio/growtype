<div class="b-post-single-inner">
    <?php if(function_exists('get_featured_image_tag') && !empty(get_featured_image_tag($post, 'medium'))) { ?>
    <div class="e-img" style="<?php echo get_featured_image_tag($post, 'medium') ?>">
        <?php if(isset($expiration_date) && !empty($expiration_date)){ ?>
        <div class="b-date">
            <div class="b-date-month">
                <?php echo date_i18n('F', strtotime($start_date)) ?>
            </div>
            <div class="b-date-day">
                <?php echo date_i18n('d', strtotime($start_date)) ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="b-content">
        <p class="e-title-upper">
            <span><?php echo isset($expiration_date) && !empty($expiration_date) ? $expiration_date : get_the_date() ?></span>
            <?php if(isset($location) && !empty($location) && !is_array($location)) { ?>
            <span class="e-separator">@</span>
            <span><?php echo $location ?></span>
            <?php } ?>
        </p>

        <?php if (!empty($post->post_title)) { ?>
        <h4>{!! $post->post_title !!}</h4>
        <?php } ?>

        <?php if (!empty($post->post_excerpt)) { ?>
        <p class="e-excerpt">{!! $post->post_excerpt !!}</p>
        <?php } ?>

        <div class="e-intro">
            <?php if (isset($content_length) && $content_length === -1) { ?>
            <?php echo $post->post_content ?>
            <?php } elseif (class_exists('Growtype_Post')) { ?>
            <?php echo Growtype_Post::content_limited($post->post_content,
                isset($content_length) ? $content_length : 200) ?>
            <?php } ?>
        </div>
    </div>
    <div class="b-actions">
        <button class="btn btn-primary">
            <?php echo isset($cta_label) ? $cta_label : __('Continue reading', 'growtype'); ?>
        </button>
    </div>
</div>
