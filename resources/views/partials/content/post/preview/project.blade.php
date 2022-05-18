<?php
$cats = [];
$post_terms = wp_get_post_terms($post->ID, 'projects_tax');

if (!is_wp_error($post_terms)) {
    foreach ($post_terms as $term) {
        array_push($cats, $term->slug);
    }
}
?>

@if(get_post_meta($post->ID, 'projects_open_in_lightbox'))
    <a href="{{get_the_post_thumbnail_url($post->ID)}}"
       class="fancybox-project b-project-single"
       data-cat="{{implode(',',$cats)}}"
       data-thumbnail="http://fancyapps.com/fancybox/demo/2_s.jpg"
       data-project-preview="<?php echo isset(get_post_meta($post->ID,
               'projects_external_url')[0]) && !empty(get_post_meta($post->ID,
           'projects_external_url')[0]) ? "<a href='" . get_post_meta($post->ID,
               'projects_external_url')[0] . "' class='btn btn-secondary'>" . __('View',
               'growtype') . "</a>" : ''?>"
       data-project-order="<a href='/#prices' class='btn btn-primary btn-order' onclick='$.fancybox.close()'><?php echo __('Order',
           'growtype')?></a>"
       rel="group"
       title="{{$post->post_title}}"
       data-fancybox>
        <div class="b-project-single-inner">
            <div class="b-mainimg" style="<?php echo get_featured_image_tag($post, 'full',
                'background-position: top;background-size: cover;') ?>"></div>
            <div class="b-content">
                <p class="e-title">{{$post->post_title}}</p>

                <p class="e-title m-cat">
                    <?php
                    $term_list = wp_get_post_terms($post->ID, 'projects_tax',
                        array ("fields" => "all"));

                    if (!is_wp_error($term_list)) {
                        foreach ($term_list as $term_single) {
                            echo '<span>' . $term_single->name . '</span>';
                        }
                    }

                    ?>
                </p>
            </div>
        </div>
    </a>
@elseif(isset(get_post_meta($post->ID, 'projects_external_url')[0]) && !empty(get_post_meta($post->ID, 'projects_external_url')[0]))
    <a href="{{get_post_meta($post->ID, 'projects_external_url')[0] ?? '#'}}"
       data-cat="{{implode(',',$cats)}}"
       target="_blank"
       class="b-project-single">
        <div class="b-project-single-inner">
            <div class="b-mainimg" style="<?php echo get_featured_image_tag($post, 'full',
                'background-position: top;background-size: cover;') ?>"></div>
            <div class="b-content">
                <p class="e-title">{{$post->post_title}}</p>

                <p class="e-title m-cat">
                    <?php
                    $term_list = wp_get_post_terms($post->ID, 'projects_tax',
                        array ("fields" => "all"));

                    if (!is_wp_error($term_list)) {
                        foreach ($term_list as $term_single) {
                            echo '<span>' . $term_single->name . '</span>';
                        }
                    }

                    ?>
                </p>
            </div>
        </div>
    </a>
@else
    <a href="{{get_permalink($post->ID)}}"
       data-cat="{{implode(',',$cats)}}"
       class="b-project-single">
        <div class="b-project-single-inner">
            <div class="b-mainimg" style="<?php echo get_featured_image_tag($post, 'full',
                'background-position: top;background-size: cover;') ?>"></div>
            <div class="b-content">
                <p class="e-title">{{$post->post_title}}</p>

                <p class="e-title m-cat">
                    <?php
                    $term_list = wp_get_post_terms($post->ID, 'projects_tax',
                        array ("fields" => "all"));

                    if (!is_wp_error($term_list)) {
                        foreach ($term_list as $term_single) {
                            echo '<span>' . $term_single->name . '</span>';
                        }
                    }
                    ?>
                </p>
            </div>
        </div>
    </a>
@endif
