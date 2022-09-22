@php
    $post = isset($post) ? $post : get_post();
@endphp

<section class="s-mainintro s-mainintro-post">
    <div class="container">
        <div class="row">
            <div class="col col-content">
                <div class="col-content-header">
                    <div class="e-date">
                        {{ get_the_date() }}
                    </div>
                    <div class="e-title-cat">
                        {!! isset(get_the_category($post)[0]) ? get_the_category($post)[0]->name : '' !!}
                    </div>
                </div>
                @if(!empty(get_the_title()))
                    <h1 class="e-title-intro">
                        {!! get_the_title() !!}
                    </h1>
                @endif
                @if(!get_theme_mod('post_single_page_reading_time_disabled'))
                    <div class="b-datetime">
                        <p class="e-time">{{ Growtype_Page::reading_time(get_the_ID()) }}</p>
                    </div>
                @endif
            </div>
            @if(!empty(get_featured_image(get_post())))
                <div class="col col-img">
                    <div class="e-img-bg-wrapper">
                        <div class="e-img-bg" style="{!! get_featured_image_tag(get_post()) !!}"></div>

                        @if(class_exists('ACF') && !empty(get_field('intro_color_opacity')))
                            <div class="m-bgoverlay" style="opacity: <?php echo get_field('intro_color_opacity')?>%;background: <?php echo get_field('intro_overlay_color')?>;"></div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
