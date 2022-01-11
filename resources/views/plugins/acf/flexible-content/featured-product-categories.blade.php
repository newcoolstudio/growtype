@php
    $intro_content = get_sub_field('intro_content');
    $categoriesToDisplay = get_sub_field('categories_to_display');
    $type = get_sub_field('type');
    $styleType = get_sub_field('style_type');
    $padding = get_sub_field('padding');
    $contentPosition = get_sub_field('content_position');
    $marginTop = get_sub_field('margin_top') ?? 0;
    $marginBottom = get_sub_field('margin_bottom') ?? 0;
@endphp

<section
        class="section container s-categories-featured m-style-{{$styleType}} m-content-{{$contentPosition}} {{$padding ? 'm-padding' : 'm-padding-disabled'}}"
        style="{{'margin-bottom: ' . $marginBottom . 'px;'}}{{'margin-top: ' . $marginTop . 'px;'}}"
>

    @if (!empty($intro_content))
        <div class="b-intro-content">
            {!! $intro_content !!}
        </div>
    @endif

    @if (!empty($categoriesToDisplay))
        <div class="b-categories m-{{$type}}">

            @if($type == 'one-four')

                @foreach ($categoriesToDisplay as $index => $category)

                    @php
                        $image = $category['image'];
                        $content = $category['content'];
                    @endphp

                    @if($index == 0)
                        <div class="categories-group">
                            @include('partials.components.product-category-preview')
                        </div>
                    @endif

                    @if($index == 1)
                        <div class="categories-group">
                            @include('partials.components.product-category-preview')
                            @endif

                            @if($index == 2 || $index == 3 || $index == 3)
                                @include('partials.components.product-category-preview')
                            @endif

                            @if($index == 4)
                                @include('partials.components.product-category-preview')
                        </div>
                    @endif

                @endforeach

            @elseif($type == 'one-two')

                @foreach ($categoriesToDisplay as $index => $category)

                    @php
                        $image = $category['image'];
                        $content = $category['content'];
                        $link_to_category = $category['link_to_category'];
                    @endphp

                    @if($index == 0)
                        <div class="categories-group">
                            @include('partials.components.product-category-preview')
                        </div>
                    @endif

                    @if($index == 1)
                        <div class="categories-group">
                            @include('partials.components.product-category-preview')
                            @endif
                            @if($index == 2)
                                @include('partials.components.product-category-preview')
                            @endif
                            @if($index == 2)
                        </div>
                    @endif

                @endforeach

            @elseif($type == 'one-one')
                @foreach ($categoriesToDisplay as $index => $category)

                    @php
                        $image = $category['image'];
                        $content = $category['content'];
                        $link_to_category = $category['link_to_category'];
                    @endphp

                    @if($index == 0 || $index == 1)
                        <div class="categories-group">
                            @include('partials.components.product-category-preview')
                        </div>
                    @endif

                @endforeach
            @elseif($type == 'one-one-one')
                @foreach ($categoriesToDisplay as $index => $category)
                    @php
                        $image = $category['image'];
                        $content = $category['content'];
                        $link_to_category = $category['link_to_category'];
                    @endphp
                    <div class="categories-group">
                        @include('partials.components.product-category-preview')
                    </div>
                @endforeach
            @endif

        </div>
    @endif
</section>
