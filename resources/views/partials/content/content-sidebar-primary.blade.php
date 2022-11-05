@if(display_sidebar_primary() && !empty(dynamic_sidebar('sidebar-primary')))
    <aside id="sidebar-primary" class="sidebar sidebar-primary widget-area">
        <?php dynamic_sidebar('sidebar-primary') ?>
    </aside>
@endif
