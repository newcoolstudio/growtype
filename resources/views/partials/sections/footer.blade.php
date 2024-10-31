<?php do_action('growtype_footer_before_open'); ?>

@if(growtype_footer_is_enabled())
    <footer id="site-footer" class="site-footer site-footer-{{growtype_get_footer_type()}}" role="contentinfo">
        <div class="container footer-inner">
                <?php do_action('growtype_footer_inner_content'); ?>
        </div>
    </footer>
@endif
