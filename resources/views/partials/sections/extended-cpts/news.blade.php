@php
    $args = array(
      'posts_per_page' => -1,
      'offset' => 0,
      'category' => '',
      'category_name' => '',
      'orderby' => 'menu_order',
      'order' => 'DESC',
      'include' => '',
      'exclude' => '',
      'post_type' => 'news',
      'post_status' => 'publish',
      'suppress_filters' => true
    );
    $posts_array = get_posts($args);
@endphp

@if(!empty($posts_array))

    <div class="section container">
        <div class="b-posts--wrapper">
                <?php
                if (function_exists('growtype_post_render_all')) {
                    echo growtype_post_render_all($posts_array, 'blog', 3, true);
                }
                ?>
        </div>
    </div>

@endif


