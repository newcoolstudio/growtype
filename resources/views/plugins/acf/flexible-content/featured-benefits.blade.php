@php
    $intro_content = get_sub_field('intro_content', get_the_ID());
    $intro_contentEnabled = get_sub_field('intro_content_enabled');
    $margin_top = get_sub_field('margin_top');
    $margin_bottom = get_sub_field('margin_bottom');
    $alignment = get_sub_field('alignment');
    $type = get_sub_field('type');
    $blockWidth = get_sub_field('block_width');
    $blockMaxWidth = get_sub_field('block_max_width');
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
@endphp

<section {!! !empty($unique_id) ? 'id="'.$unique_id.'"' : '' !!}  class="section" style="margin-top: {{$margin_top}}px;margin-bottom: {{$margin_bottom}}px;">
    <div class="container">
        <div class="b-intro-content">
            {!! $intro_content !!}
        </div>
        <div class="b-benefits b-benefits-{{$type}}">
            @if( have_rows('benefits') )
                @while ( have_rows('benefits') ) @php the_row(); @endphp
                @php
                    $image_width = !empty(get_sub_field('image_width_is_not_f_editable')) ? 'max-width: ' . get_sub_field('image_width_is_not_f_editable') . ';' : '';
                    $image_padding = !empty(get_sub_field('image_padding_is_not_f_editable')) ? 'padding: ' . get_sub_field('image_padding_is_not_f_editable') . ';' : '';
                @endphp
                <div class="b-benefits-single m-{{$alignment}}" style="{{!empty($blockWidth) ? 'width:' . $blockWidth . '%;' : ''}}">
                    <div class="b-benefits-single-inner" style="{{!empty($blockMaxWidth) ? 'max-width:' . $blockMaxWidth . 'px;' : ''}}">
                        @if($alignment === 'vertical')
                            <img class="img-fluid" src="{!! get_sub_field('image') !!}" alt="" style="{{$image_width}}{{$image_padding}}">
                            {!! get_sub_field('content') !!}
                        @else
                            <div class="e-img">
                                <img class="img-fluid" src="{!! get_sub_field('image') !!}" alt="" style="{{$image_width}}{{$image_padding}}">
                            </div>
                            <div class="e-text">
                                {!! get_sub_field('content') !!}
                            </div>
                        @endif
                    </div>
                </div>
                @endwhile
            @endif
        </div>
    </div>
</section>
