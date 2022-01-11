@php
    $sliderHeight = get_sub_field('slider_height_is_not_f_editable');
    $sliderHeightMobile = get_sub_field('slider_height_mobile_is_not_f_editable');
    $sliderType = get_sub_field('slider_type');
    $margin_top = get_sub_field('margin_top');
    $margin_bottom = get_sub_field('margin_bottom');
    $automatic = get_sub_field('automatic_slider');
    $styleType = get_sub_field('style_type');
    $hasArrows = get_sub_field('has_arrows');
    $hasButtons = get_sub_field('has_buttons');
    $rowIndex = get_row_index();
@endphp

@push('pageStyles')
    <style>
        .photoslider-{{$rowIndex}} .photoslider-slide .container {
            min-height: {{$sliderHeight}};
        }

        @media only screen and (max-width: 640px) {
            .photoslider-{{$rowIndex}} .photoslider-slide .container {
                min-height: {{$sliderHeightMobile}};
            }
        }
    </style>
@endpush

<section class="section photoslider-{{$rowIndex}} photoslider photoslider-{{$sliderType}} photoslider-{{$styleType}} {{$automatic ? 'photoslider-automatic' : ''}} {{$hasButtons ? 'has-buttons' : ''}} {{$hasArrows ? 'has-arrows' : ''}}" style="margin-top: {{$margin_top}}px;margin-bottom: {{$margin_bottom}}px;">
    @if($sliderType === 'classic' || $sliderType === 'fullwidth')
        <div class="photoslider-inner">
            @php
                if( have_rows('slide') ):
                while ( have_rows('slide') ) : the_row();

                $slideIndex = get_row_index();

                $backgroundImage = get_sub_field('background_image');
                $content = get_sub_field('content');
                $overlayColor = get_sub_field('overlay_color');
                $overlayOpacity = get_sub_field('overlay_opacity') ? get_sub_field('overlay_opacity') / 100 : 0;

                $backgroundSizeSelectDesktop = get_sub_field('background_size_select_desktop') ?? 'cover';
                $backgroundRepeatSelectDesktop = get_sub_field('background_repeat_select_desktop') ?? 'no-repeat';

                $backgroundPositionXSelectDesktop = get_sub_field('background_position_x_select_desktop');
                $backgroundPositionYSelectDesktop = get_sub_field('background_position_y_select_desktop');
                $backgroundPositionXCustomDesktop = get_sub_field('background_position_x_custom_desktop');
                $backgroundPositionYCustomDesktop = get_sub_field('background_position_y_custom_desktop');

                if($backgroundPositionXSelectDesktop === 'custom'){
                    $backgroundPositionXSelectDesktop = $backgroundPositionXCustomDesktop;
                }

                if($backgroundPositionYSelectDesktop === 'custom'){
                    $backgroundPositionYSelectDesktop = $backgroundPositionYCustomDesktop;
                }

                $backgroundPosition = $backgroundPositionXSelectDesktop . ' ' . $backgroundPositionYSelectDesktop;

                $textColor = get_sub_field('text_color');
            @endphp

            @push('pageStyles')
                <style>
                    .photoslider-{{$rowIndex}} .photoslider-slide-{{$slideIndex}}                                                                        {
                        background: url({{$backgroundImage}});
                        background-size: {{$backgroundSizeSelectDesktop}};
                        background-position: {{$backgroundPosition}};
                        background-repeat: {{$backgroundRepeatSelectDesktop}};
                        color: {{$textColor}};
                    }
                </style>
            @endpush
            <div class="photoslider-slide photoslider-slide-{{$slideIndex}}">
                <div class="container">
                    <div class="content">
                        {!! $content !!}
                    </div>
                </div>
                <div class="overlay" style="background:{{$overlayColor}};opacity: {{$overlayOpacity}};"></div>
            </div>
        <?php
                endwhile;
                endif;
                ?>
        </div>
    @elseif($sliderType === 'logos')
        @php
            $gallery = get_sub_field('gallery');
        @endphp
        <div class="photoslider-inner container">
            @foreach($gallery as $image)
                <div class="photoslider-slide">
                    <div class="photoslider-slide-inner" style="background: url({{$image['url']}});background-size: contain;background-position: center;background-repeat: no-repeat;"></div>
                </div>
            @endforeach
        </div>
    @endif

</section>
