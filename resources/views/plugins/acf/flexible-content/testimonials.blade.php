@php
    $intro_content = get_sub_field('intro_content');
    $testimonials = get_sub_field('select_testimonials');
    $amount_visible = get_sub_field('amount_visible');
    $arrows = get_sub_field('arrows');
    $testimonial_style = get_sub_field('testimonial_style');
    $block_style = get_sub_field('block_style');
    $bg_color = !empty(get_sub_field('background_color')) ? 'background-color: ' . get_sub_field('background_color') . ';' : '';
    $margin_top = !empty(get_sub_field('margin_top')) ? 'margin-top: ' . get_sub_field('margin_top') . 'px;' : 'margin-top:0;';
    $margin_bottom = !empty(get_sub_field('margin_bottom')) ? 'margin-bottom: ' . get_sub_field('margin_bottom') . 'px;' : 'margin-bottom:0;';

    if(!$testimonials){
        $testimonials = get_posts(array (
                'post_type' => 'testimonial',
                'post_status' => 'publish',
                'posts_per_page' => -1
            ));
    }
@endphp

<section class="section s-testimonials s-testimonials-{{$block_style}} s-testimonials-{{$testimonial_style}}"
         style="<?php echo $bg_color ?><?php echo $margin_top ?><?php echo $margin_bottom ?>"
         data-amount="{{$amount_visible ?? 2}}"
         data-arrows="{{$arrows ?? false}}"
>
    <div class="s-testimonials--wrapper">
        <div class="container">
            {!! $intro_content !!}

            <div class="s-testimonials--inner">
                <?php foreach ($testimonials as $testimonial) { ?>
                @php
                    $tax = get_the_terms($testimonial, 'testimonials_tax');
                    $tax = empty($tax->errors) ? $tax[0] : null;
                @endphp
                @if($testimonial_style === 'picture-top')
                        @include('partials.content.testimonials.preview.picture-top')
                @else
                        @include('partials.content.testimonials.preview.picture-bottom')
                @endif
                <?php } ?>
            </div>
        </div>
    </div>
</section>
