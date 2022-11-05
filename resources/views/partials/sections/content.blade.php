<div class="content-wrapper {!! $section_class ?? null !!}">
    <div class="container">
        <div class="content">
            <?php echo apply_filters('the_content', get_the_content()) ?>
        </div>
    </div>
</div>
