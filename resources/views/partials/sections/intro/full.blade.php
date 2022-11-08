<section class="s-mainintro s-mainintro-full" style="{!! class_exists('ACF') && get_field('featured_img_enabled') ? growtype_get_featured_image_tag(get_post()) : '' !!}">

    <div class="container">
        <div class="row">
            @if(!empty(get_the_content()))
                <div class="col">
                    <div class="entry-content">
                        @if(!empty(get_the_title()) && !is_front_page())
                            <h2 class="e-title-intro">
                                {!! get_the_title() !!}
                            </h2>
                        @endif
                        @php echo apply_filters('the_content', get_the_content()); @endphp
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if (isset($post) && has_post_thumbnail($post) && class_exists('ACF'))
        <div class="m-bgoverlay" style="opacity: <?php echo get_field('intro_color_opacity')?>%;background: <?php echo get_field('intro_overlay_color')?>;"></div>
    @endif
</section>
