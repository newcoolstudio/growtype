<div id="panel" class="panel panel-area panel-<?php echo esc_html(get_theme_mod('panel_style')) ?>">
    <div class="panel-header">
        @include('partials.components.panel.logo')
    </div>

    @if(get_theme_mod('panel_show_user_profile'))
        @include('partials.components.panel.profile')
    @endif

    @include('partials.components.panel.nav')

    <div class="b-support">
        <h3 class="e-title">{!! __('Need help?','growtype') !!}</h3>
        <div class="b-support-intro">
            <div class="b-support-content-image">
                <img src="{!! get_parent_template_public_path() . '/images/support/men.png' !!}" class="img-fluid" alt="">
            </div>
            <div class="b-support-content-details">
                <h4 class="e-title">{!! __('Customer service','growtype') !!}</h4>
                <p>{!! __('24/7 available to help','growtype') !!}</p>
            </div>
        </div>
        <div class="b-support-content">
            <a href="mailto:info@memberbid.com" data-type="mailto" data-id="mailto:info@memberbid.com">
                <span class="dashicons dashicons-email"></span>info@memberbid.com
            </a>
            <a href="tel:+37061202334">
                <span class="dashicons dashicons-phone"></span>+370 612 02334
            </a>
        </div>
    </div>

    <div class="panel-bg"></div>
</div>
