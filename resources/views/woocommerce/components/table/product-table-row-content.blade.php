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
</tr>
