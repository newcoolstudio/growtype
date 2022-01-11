<?php
$args = array(
    'posts_per_page' => -1,
    'offset' => 0,
    'category' => '',
    'category_name' => '',
    'orderby' => 'menu_order',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'post_type' => 'testimonials',
    'post_status' => 'publish',
    'suppress_filters' => true
);
$posts_array = get_posts($args);
if(!empty($posts_array)){ ?>
    <div class="s-testimonials m-wrapper">
        <div class="s-testimonials--inner">

            <?php
            foreach ($posts_array as $testimonial) { ?>
                <div class="s-testimonials--single">
                    <div class="b-testimonials--single--content">
                        <?php echo $testimonial->post_content ?>
                    </div>
                    <div class="b-testimonials--single--title">
                        <?php echo $testimonial->post_title ?>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
<?php } ?>


