<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <?php do_action('growtype_head_viewport') ?>

    @php wp_head() @endphp

    @yield('headerScripts')
    @stack('headerScripts')

    @yield('pageStyles')
    @stack('pageStyles')

    @if(!empty(growtype_get_font_details('primary_font')))
        <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" href="<?php echo growtype_get_font_url(growtype_get_font_details('primary_font')) ?>">
    @endif

    @if(!empty(growtype_get_font_details('secondary_font')) && growtype_get_font_details('primary_font')->font !== growtype_get_font_details('secondary_font')->font && growtype_secondary_font_is_active())
        <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" href="<?php echo growtype_get_font_url(growtype_get_font_details('secondary_font')) ?>">
    @endif

    <?php do_action('growtype_head') ?>
</head>
