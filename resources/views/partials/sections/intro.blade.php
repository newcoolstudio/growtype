<section class="section s-mainintro {!! $section_class ?? null !!}">
    <div class="container">
        <div class="row">
            @if(!empty(get_the_content()))
                <div class="col col-content">
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
            @if(class_exists('ACF') && get_field('featured_img_enabled') && !empty(get_featured_image(get_post())))
                <div class="col col-img">
                    <div class="e-img-bg-wrapper">
                        <div class="e-img-bg" style="{!! get_featured_image_tag(get_post()) !!}"></div>

                        @if(!empty(get_field('intro_color_opacity')))
                            <div class="m-bgoverlay" style="opacity: <?php echo get_field('intro_color_opacity')?>%;background: <?php echo get_field('intro_overlay_color')?>;"></div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
