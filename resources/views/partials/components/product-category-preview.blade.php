<div class="categories-wrap">
    @php
        $entire_block_is_a_link = $category['entire_block_is_a_link'];
        $url = $category['url'];
        $link_to_category = $category['link_to_category'];
        $link_type = $category['link_type'];
        $link_to_category = !empty($link_to_category) ? get_permalink($link_to_category->ID) : $url;
        if($link_type === 'url'){
         $link_to_category = $url;
        }
    @endphp
    @if($entire_block_is_a_link)
        <a class="categories-single" href="{{$link_to_category}}" style="background: url({{$image}});background-size: cover;background-position: center;">
            <div class="categories-single-footer">
                <?php
                $content = preg_replace('#<a.*?>([^>]*)</a>#i', '<button class="btn btn-primary">$1</button>',
                    $content);
                ?>
                {!! $content !!}
            </div>
        </a>
    @else
        <div class="categories-single" style="background: url({{$image}});background-size: cover;background-position: center;">
            <div class="categories-single-footer">
                {!! $content !!}
            </div>
        </div>
    @endif
</div>

