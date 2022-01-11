@php
    $intro_content = get_sub_field('intro_content');
    $products_to_display = get_sub_field('products_to_display');
    $is_slider = get_sub_field('is_slider');
    $contact_details = get_sub_field('contact_details');
    $margin_top = get_sub_field('margin_top');
    $margin_bottom = get_sub_field('margin_bottom');
    $block_style = get_sub_field('block_style');
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
    $block_background = !empty(get_sub_field('block_background')) ? 'background:' . get_sub_field('block_background') : '';
@endphp

<section {!! !empty($unique_id) ? 'id="'.$unique_id.'"' : '' !!} class="section b-products-featured b-products-{{$block_style}} " style="margin-top: {{$margin_top}}px;margin-bottom: {{$margin_bottom}}px;{{$block_background}}">
    <div class="container">
        @if (!empty($intro_content))
            <div class="b-intro-content">
                {!! $intro_content !!}
            </div>
        @endif

        @if (!empty($products_to_display))
            <div class="woocommerce b-products">
                <ul class="products products-amount-{{count($products_to_display)}} {{$is_slider == true ? 'is-slider-product' : ''}}">
                    @foreach ($products_to_display as $index => $product)
                        @if($block_style === 'plans')
                            @include('partials.components.product-preview-plans')
                        @else
                            @include('partials.components.product-preview')
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
