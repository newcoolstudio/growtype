<?php
$loop = new WP_Query($product);

$filterClasses = true;

if ($loop->have_posts()) {
    while ($loop->have_posts()) : $loop->the_post();
        ?>
          @include('woocommerce.content-product')
        <?php
    endwhile;
}
wp_reset_postdata();
?>
