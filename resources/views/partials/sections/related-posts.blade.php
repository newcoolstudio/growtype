<?php
$first_tag = !empty(wp_get_post_tags(get_the_id())) ? wp_get_post_tags(get_the_id())[0]->term_id : '';

$args = array (
    'post_type' => get_post_type(),
    'post__not_in' => array (get_the_id()),
    'posts_per_page' => 3,
    'orderby' => 'menu_order',
    'order' => 'DESC',
);

if (!empty($first_tag)) {
    $args['tag__in'] = array ($first_tag);
}

$posts = new WP_Query($args);

if( $posts->have_posts() ) {
?>

<section class="s-posts s-posts-related">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="block-title">
                    <h3 class="e-title-section"><?php echo __('Read more', 'growtype') ?></h3>
                </div>
                <div class="b-posts">
                    <?php
                    while ($posts->have_posts()) : $posts->the_post(); ?>
                    <div class="b-post-wrapper">
                        @php($post = get_post())
                        @include('partials.content.post.preview.basic')
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php }
wp_reset_query();
?>