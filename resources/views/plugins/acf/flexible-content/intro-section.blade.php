@php
    $bg_image = !empty(get_sub_field('background_img')) ? 'background: url('.get_sub_field('background_img').');background-position: center;background-size: cover;' : '';
    $block_content = get_sub_field('main_text');
    $max_width = get_sub_field('block_max_width');
    $margin_top = !empty(get_sub_field('margin_top')) ? 'margin-top: ' . get_sub_field('margin_top') . 'px;' : 'margin-top:0;';
    $margin_bottom = !empty(get_sub_field('margin_bottom')) ? 'margin-bottom: ' . get_sub_field('margin_bottom') . 'px;' : 'margin-bottom:0;';
    $padding_top = !empty(get_sub_field('padding_top')) ? 'padding-top: ' . get_sub_field('padding_top') . 'px;' : 'padding-top:0;';
    $padding_bottom = !empty(get_sub_field('padding_bottom')) ? 'padding-bottom: ' . get_sub_field('padding_bottom') . 'px;' : 'padding-bottom:0;';
    $min_height = !empty(get_sub_field('minimum_height')) ? 'min-height: ' . get_sub_field('minimum_height') . 'px;' : '';
    $block_style = get_sub_field('style_type');
    $text_color = !empty(get_sub_field('text_color')) ? 'color: ' . get_sub_field('text_color') . ';' : '';
    $bg_color = !empty(get_sub_field('background_color')) ? 'background-color: ' . get_sub_field('background_color') . ';' : '';
    $bg_opacity = !empty(get_sub_field('background_opacity')) ? get_sub_field('background_opacity') / 100 : '0.8';
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
@endphp

<section id="{{$unique_id}}"
         class="section c-contentblock--full c-contentblock-{{$block_style}} <?php echo !empty($bg_color) ? 'has-overlay' : '' ?>"
         style="<?php echo $bg_image ?><?php echo $bg_color ?><?php echo $text_color ?><?php echo $min_height ?><?php echo $margin_top ?><?php echo $margin_bottom ?><?php echo $padding_top ?><?php echo $padding_bottom ?>">
    <div class="container c-contentblock--full--inner">
        <div class="b-content" style="max-width: {{$max_width}}px;">
            {!! $block_content !!}
        </div>
        @if (!empty($bg_color))
            <div class="e-bgoverlay" style="opacity: {{$bg_opacity}}; background: {{$bg_color}}"></div>
        @endif
    </div>
</section>
