@php
    $section_style = !empty(get_sub_field('section_style')) ? get_sub_field('section_style') : '';
    $block_style = !empty(get_sub_field('block_style')) ? get_sub_field('block_style') : '';
    $blockSpacing = !empty(get_sub_field('block_spacing')) ? get_sub_field('block_spacing') : '';
    $margin_top = !empty(get_sub_field('margin_top')) ? 'margin-top: ' . get_sub_field('margin_top') . 'px;' : 'margin-top:0;';
    $margin_bottom = !empty(get_sub_field('margin_bottom')) ? 'margin-bottom: ' . get_sub_field('margin_bottom') . 'px;' : 'margin-bottom:0;';
    $padding_top = !empty(get_sub_field('padding_top')) ? 'padding-top: ' . get_sub_field('padding_top') . 'px;' : 'padding-top:0;';
    $padding_bottom = !empty(get_sub_field('padding_bottom')) ? 'padding-bottom: ' . get_sub_field('padding_bottom') . 'px;' : 'padding-bottom:0;';
    $text_color = !empty(get_sub_field('text_color')) ? 'color: ' . get_sub_field('text_color') . ';' : '';
    $bg_color = !empty(get_sub_field('background_color')) ? 'background-color: ' . get_sub_field('background_color') . ';' : '';
    $bg_opacity = !empty(get_sub_field('background_opacity')) ? 'opacity:' . get_sub_field('background_opacity') / 100 . ';' : 'opacity:' . '0;';
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
@endphp

<section id="{{$unique_id}}" class="section c-contentblock--half c-contentblock-{{$section_style}} m-{{$block_style}} m-spacing-{{$blockSpacing}}"
         style="<?php echo $margin_top ?><?php echo $margin_bottom ?><?php echo $padding_top ?><?php echo $padding_bottom ?><?php echo $text_color ?>">
    <div class="container c-contentblock-inner">
        @php
            $post_subtitle = get_sub_field('subtitle_block');
            $icon = get_sub_field('icon_block');
            $position = get_sub_field('direction');
            $maxWidth = get_sub_field('block_max_width');
            $direction = 'm-dir-left';

            if ($position === 'image_right') {
            $direction = 'm-dir-right';
            }
        @endphp

        <div class="b-imagetext <?php echo $direction ?>" style="max-width: <?php echo $maxWidth ?>px;margin: auto;">

            <?php
            $blockMainImg = get_sub_field('image_block');
            $blockMainImgSize = get_sub_field('background_size');
            $blockMainImgPosition = get_sub_field('background_image_position');
            $blockTitle = get_sub_field('title_block');
            $blockBgColor = get_sub_field('content_bg_color');
            ?>

            <div class="c-contentmultiple-img">
                <span class="img-inner" style="background: url('<?php echo $blockMainImg ?>');background-size: <?php echo $blockMainImgSize ?>;background-position: <?php echo$blockMainImgPosition?>;background-repeat: no-repeat;"></span>
            </div>

            <div class="c-contentmultiple-content">
                <?php
                if (!empty($btnUrl)) { ?>
                <div class="content" style="background: {{$blockBgColor}};"><?php the_sub_field('content_block'); ?></div>
                <a href="<?php echo $btnUrl; ?>" class="c-btn"><span><?php echo $urlText; ?></span></a>
                <?php } else { ?>
                <?php
                if (!empty($icon)) {
                    echo '<img src="' . $icon . '" class="icon">';
                }
                ?>
                <?php if (!empty($post_subtitle)) { ?>
                <p class="e-subtitle"><?php echo $post_subtitle ?></p>
                <?php } ?>
                <?php if ($blockTitle) { ?>
                <div class="e-title">
                    <h2><?php echo $blockTitle ?></h2>
                </div>
                <?php } ?>
                <div class="content" style="background: {{$blockBgColor}};"><?php the_sub_field('content_block'); ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
    @if (!empty($bg_color))
        <div class="e-bgoverlay" style="{{$bg_opacity}}{{$bg_color}}"></div>
    @endif
</section>
