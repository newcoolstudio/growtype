@php
    $intro_content = get_sub_field('intro_content');
    $postsToDisplay = get_sub_field('posts_to_display');
    $is_slider = get_sub_field('is_slider');
    $contact_details = get_sub_field('contact_details');
    $section_style = get_sub_field('section_style');
    $block_style = get_sub_field('block_style');
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
    $section_bg_color = !empty(get_sub_field('section_bg_color')) ? 'background-color: ' . get_sub_field('section_bg_color') . ';' : '';
    $margin_top = !empty(get_sub_field('margin_top')) ? 'margin-top: ' . get_sub_field('margin_top') . 'px;' : 'margin-top:0;';
    $margin_bottom = !empty(get_sub_field('margin_bottom')) ? 'margin-bottom: ' . get_sub_field('margin_bottom') . 'px;' : 'margin-bottom:0;';
    $padding_top = !empty(get_sub_field('padding_top')) ? 'padding-top: ' . get_sub_field('padding_top') . 'px;' : 'padding-top:0;';
    $padding_bottom = !empty(get_sub_field('padding_bottom')) ? 'padding-bottom: ' . get_sub_field('padding_bottom') . 'px;' : 'padding-bottom:0;';

if(!$postsToDisplay){
        $postsToDisplay = get_posts(array (
                'post_type' => 'office',
                'post_status' => 'publish',
                'posts_per_page' => -1
            ));
    }
@endphp

<section {!! !empty($unique_id) ? 'id="'.$unique_id.'"' : '' !!} class="section s-offices s-offices-{{$section_style}} "
         style="{{$margin_top}}{{$margin_bottom}}{{$section_bg_color}}{{$padding_top}}{{$padding_bottom}}">
    <div class="container">
        @if (!empty($intro_content))
            <div class="b-intro-content">
                {!! $intro_content !!}
            </div>
        @endif

        @if (!empty($postsToDisplay))
            <div class="b-offices">
                <div class="b-offices-inner {{$is_slider == true ? 'is-slider-offices' : ''}}">
                    @foreach ($postsToDisplay as $index => $post)
                        <div class="col-6 col-md-3">
                            <div class="b-office-wrapper">
                                @include('partials.content.office.preview.horizontal')
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
