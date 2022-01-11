@php
    $intro_content = get_sub_field('intro_content');
    $images = get_sub_field('gallery');
@endphp

@include('plugins.acf.galleries.main', ['images' => $images])
