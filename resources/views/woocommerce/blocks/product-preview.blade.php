<li class="wc-block-grid__product {!! isset($data->classes) ? implode(' ', $data->classes) : null !!}">
    {!! !empty($data->permalink) ? '<a href="'.$data->permalink.'">' : '<div>' !!}

    @if(isset($data->promo_label))
        {!! $data->promo_label !!}
    @endif

    {!! $data->image !!}
    {!! $data->title !!}

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

    {!! !empty($data->permalink) ? '</a>' : '</div>' !!}

    {!! $data->button !!}
</li>
