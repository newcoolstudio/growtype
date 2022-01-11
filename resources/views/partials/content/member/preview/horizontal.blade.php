<?php
$title_upper = $title_upper ?? $post->post_excerpt ?? null;
$f_image = get_featured_image_tag($post, 'full',
    'background-position: top;background-size: cover;');

if (empty($f_image)) {
    $f_image = 'background: url(' . get_parent_theme_file_uri() . '/public/images/avatar/default.png' . ');background-size: cover;background-position: center;';
}
?>

<div class="b-member-single b-member-single-horizontal"
     data-id="{!! $post->ID !!}"
     data-location="{!! $location ?? null !!}"
     data-industry="{!! $industry ?? null !!}"
     data-position="{!! $position ?? null !!}"
>
    <div class="b-member-single-inner">
        <div class="b-mainimg-wrapper">
            <div class="b-mainimg" style="{!! $f_image !!}"></div>
        </div>
        <div class="b-content">
            @if(!empty($title_upper))
                <p class="e-title-upper">{!! $title_upper!!}</p>
            @endif
            <p class="e-title">{{$post->post_title}}</p>
            @if(!empty(get_the_content()))
                <div class="e-details">
                    {!! apply_filters( 'the_content', $post->post_content ) !!}

                    @include('plugins.acf.contacts.basic')
                </div>
            @endif
        </div>
    </div>
</div>
