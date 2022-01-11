@php
    $intro_content = get_sub_field('intro_content');
    $posts_to_display = get_sub_field('posts_to_display');
    $posts_amount = get_sub_field('posts_amount');
    $is_slider = get_sub_field('is_slider');
    $slider_style = !empty(get_sub_field('slider_style')) ? 'slider-style-' . get_sub_field('slider_style') : '';
    $contact_details = get_sub_field('contact_details');
    $margin_top = !empty(get_sub_field('margin_top')) ? 'margin-top: '.get_sub_field('margin_top').'px;' : 'margin-top: 0;';
    $margin_bottom = !empty(get_sub_field('margin_bottom')) ? 'margin-bottom: '.get_sub_field('margin_bottom').'px;' : 'margin-bottom: 0;';
    $bg_color = !empty(get_sub_field('background_color')) ? 'background-color: '.get_sub_field('background_color').';' : '';
    $text_color = !empty(get_sub_field('text_color')) ? 'color: '.get_sub_field('text_color').';' : '';
    $section_style = !empty(get_sub_field('section_style')) ? 's-member-' . get_sub_field('section_style') : '';
    $block_style = !empty(get_sub_field('block_style')) ? 'b-member-' . get_sub_field('block_style') : '';
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
    $slides_to_show = !empty(get_sub_field('slides_to_show')) ? get_sub_field('slides_to_show') : '4';
    $content_direction = !empty(get_sub_field('content_direction')) ? get_sub_field('content_direction') : '';
    $padding_top = !empty(get_sub_field('padding_top')) ? 'padding-top: ' . get_sub_field('padding_top') . 'px;' : 'padding-top:0;';
    $padding_bottom = !empty(get_sub_field('padding_bottom')) ? 'padding-bottom: ' . get_sub_field('padding_bottom') . 'px;' : 'padding-bottom:0;';

if(!$posts_to_display){
        $posts_to_display = get_posts(array (
                'post_type' => 'member',
                'post_status' => 'publish',
                'posts_per_page' => empty($posts_amount) ? '-1' : $posts_amount,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ));
    }
@endphp

<section {!! !empty($unique_id) ? 'id="'.$unique_id.'"' : '' !!}
         class="section s-member {{$section_style}} {{$slider_style}}"
         style="{{$margin_top}}{{$margin_bottom}}{{$padding_top}}{{$padding_bottom}}{{$bg_color}}{{$text_color}}">
    <div class="container">
        @if (!empty($intro_content))
            <div class="b-intro-content">
                {!! $intro_content !!}
            </div>
        @endif

        @if (!empty($posts_to_display))
            <div class="b-member {{$block_style}}">
                <div class="b-member-inner {{$is_slider == true ? 'is-slider-member' : ''}}" data-slides-to-show="{{$slides_to_show}}" data-slides-existing-amount="{!! count($posts_to_display) !!}">
                    @foreach ($posts_to_display as $index => $post)
                        @if($content_direction === 'vertical')
                            @include('partials.content.member.preview.vertical')
                        @else
                            @include('partials.content.member.preview.horizontal')
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
