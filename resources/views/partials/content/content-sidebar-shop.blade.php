@if(display_shop_catalog_sidebar() && dynamic_sidebar('sidebar-shop'))
    <aside id="sidebar-shop" class="sidebar sidebar-shop widget-area">
        <?php dynamic_sidebar('sidebar-shop'); ?>
    </aside>
@endif
