<li class="wc-block-grid__product {!! isset($data->classes) ? implode(' ', $data->classes) : null !!}">
    @if(isset($data->promo_label))
        <span class="badge badge-promo bg-primary">{!! $data->promo_label !!}</span>
    @endif

    <a href="{!! $data->permalink !!}" class="wc-block-grid__product-link">
        {!! $data->image !!}
        {!! $data->title !!}
    </a>

    {!! $data->badge !!}

    @if(isset($data->description))
        <div class="wc-block-grid__product-content">
            {!! $data->description !!}
        </div>
    @endif

    @if(isset($data->price) || isset($data->price_details))
        <div class="price-wrapper">
            @if(isset($data->price))
                {!! $data->price !!}
            @endif

            @if(isset($data->price_details))
                <span class="price-details">{!! $data->price_details !!}</span>
            @endif
        </div>
    @endif

    {!! $data->rating !!}

    {!! $data->button !!}
</li>
