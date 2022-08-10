<?php
$post = isset($post) ? $post : get_post();
$terms = wp_get_post_terms($post->ID, get_post_type($post) . '_tax');

$start_date = class_exists('ACF') ? get_field('start_date', $post) : '';
$end_date = class_exists('ACF') ? get_field('end_date', $post) : '';
$expiration_date = !empty($end_date) ? $end_date : $start_date;

$post_is_expired = !empty($expiration_date) && strtotime($expiration_date) < strtotime(date('Y-m-d H:i:s')) ? 'is-expired' : '';

$post_classes_list = ['b-post-single'];

if (isset($extra_class) && !empty($extra_class)) {
    array_push($post_classes_list, $extra_class);
}

if (isset($post_is_expired) && !empty($post_is_expired)) {
    array_push($post_classes_list, $post_is_expired);
}

$post_classes = implode(' ', $post_classes_list);

$location = get_post_meta($post->ID, 'location', true);

if (isset($post_link) && $post_link === false) { ?>
<div class="<?php echo $post_classes ?>">
    @include('partials.content.post.preview.basic-content-inner')
</div>
<?php } else { ?>
<a href="<?php echo get_permalink($post->ID) ?>" class="<?php echo isset($post_classes) ? $post_classes : '' ?>" data-cat="<?php echo isset($terms) && !empty($terms) ? implode(',', array_pluck($terms, 'slug')) : '' ?>">
    @include('partials.content.post.preview.basic-content-inner')
</a>
<?php } ?>
