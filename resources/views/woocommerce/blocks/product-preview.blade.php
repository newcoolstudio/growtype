<li class="wc-block-grid__product {!! isset($data->classes) ? implode(' ', $data->classes) : null !!}">
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
    @if(isset($data->price))
        {!! $data->price !!}
    @endif
    {!! $data->rating !!}
    {!! $data->button !!}
</li>
