@php
    $shortcodeType = get_sub_field('shortcode_type');
    $shortcode = get_sub_field('shortcode_value');
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
@endphp

<div id="{{$unique_id}}" class="shortcode-wrapper">
    @if($shortcodeType === 'instagram')
        @php
            echo do_shortcode('[instagram-feed]')
        @endphp
    @else
        @php
            echo do_shortcode($shortcode)
        @endphp
    @endif
</div>
