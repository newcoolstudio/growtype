<div class="content-wrapper {!! $section_class ?? null !!}">
    <div class="container">
        <div class="content">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</div>
