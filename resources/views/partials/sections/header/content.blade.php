<?php do_action('growtype_header_inner_after_open'); ?>

@include('partials.components.logo.header')

{!! Growtype_Page::title_render() !!}

@if(!empty(Growtype_Header::extra_content()))
    <div class="header-extra-content-wrapper">
        {!! Growtype_Header::extra_content() !!}
    </div>
@endif

@if(growtype_header_main_menu_is_enabled())
    @include('partials.components.menu.main')
@endif

@if(growtype_header_mobile_menu_is_enabled())
    @include('partials.components.menu.mobile')
@endif

@include('partials.components.menu.side')

@if(growtype_header_login_menu_is_enabled())
    @include('partials.components.menu.login')
@endif

<?php do_action('growtype_header_inner_before_close'); ?>
