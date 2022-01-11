<a href="<?php echo get_permalink($singlePost) ?>" class="b-post-preview <?php echo !empty(get_featured_image_tag($singlePost)) ? 'has-featuredimg' : '' ?>">
  <div class="b-post-preview-inner" style="<?php echo get_featured_image_tag($singlePost) ?>">
    <div class="b-post-preview-desc">
      <h5 class="e-title"><?php echo $singlePost->post_title ?></h5>
      <p><?php echo $singlePost->post_excerpt ?></p>
    </div>
  </div>
</a>
