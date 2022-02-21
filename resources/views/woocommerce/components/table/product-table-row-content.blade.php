<tr {!! $classes !!}>
    <td>
        {{ do_action('woocommerce_before_shop_loop_item') }}
    </td>
    <td>
        <div class="e-img" style="{!! get_featured_image_tag(get_post()) !!}"></div>
    </td>
    <td>
        <a class="e-title e-heading" href="{!! get_permalink($product->get_id()) !!}">{!! $product->get_title() !!}</a>
        <div class="e-details e-description">
            <span>{!! Growtype_Product::amount_in_units_formatted() !!}</span>
            <span class="e-separator">•</span>
            <span>{!! Growtype_Product::volume_formatted() !!}</span>
        </div>
    </td>
    <td>
        <div class="e-heading">{!! Growtype_Auction::price_per_unit_formatted() !!}</div>
        <div class="e-description">{!! __('Price per bottle', 'growtype') !!}</div>
    </td>
    <td>
        <div class="e-heading">{!! Growtype_Auction::bid_value_formatted() !!}</div>
        <div class="e-description">{!! __('Full price', 'growtype') !!}</div>
    </td>
    <td>
        <div class="e-heading">{!! Growtype_Auction::buy_now_price_formatted() !!}</div>
        <div class="e-description">{!! __('Buy now price', 'growtype') !!}</div>
    </td>
    <td>
        @if (Growtype_Auction::has_started())
            <div class="e-heading">{!! Growtype_Auction::time_remaining() !!}</div>
            <div class="e-description">{!! __('Time left until end', 'growtype') !!}</div>
        @else
            <div class="e-heading">{!! Growtype_Auction::time_to_auction() !!}</div>
            <div class="e-description">{!! __('Time left until start', 'growtype') !!}</div>
        @endif
    </td>
    <td>
        <div class="e-heading">{!! Growtype_Auction::duration_formatted() !!}</div>
        <div class="e-description">{!! __('Auction duration', 'growtype') !!}</div>
    </td>
</tr>
