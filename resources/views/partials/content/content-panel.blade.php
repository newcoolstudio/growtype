<div id="panel" class="panel panel-area panel-<?php echo esc_html(get_theme_mod('panel_style')) ?>">
    <div class="panel-inner">
        <div class="btn-panel-close"></div>

        @if(get_theme_mod('panel_has_header'))
            <div class="panel-header">
                @include('partials.components.panel.logo')
            </div>
        @endif

        @if(get_theme_mod('panel_show_user_profile'))
            @include('partials.components.panel.profile')
        @endif

        @include('partials.components.panel.nav')

        <div class="panel-bg"></div>
    </div>
</div>
