<div class="content-wrapper {!! $section_class ?? null !!}">
    <div class="container">
        <div class="content">
            <?php do_action('growtype_content_after_open') ?>
            <?php echo apply_filters('the_content', get_the_content()) ?>
            <?php do_action('growtype_content_before_close') ?>
        </div>
    </div>
</div>
