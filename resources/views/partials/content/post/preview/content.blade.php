<?php
$post = isset($post) ? $post : get_post();
$terms = wp_get_post_terms($post->ID, get_post_type($post) . '_tax');
?>

<div class="b-post-single b-post-content" data-cat="{!! !empty($terms) ? implode(',',array_pluck($terms,'slug')) : '' !!}">
    {!! apply_filters( 'the_content', $post->post_content ) !!}
</div>
