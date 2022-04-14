<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    @if(!empty(get_option('paysera_verification_meta_code')))
        <meta name="verify-paysera" content="{{get_option('paysera_verification_meta_code')}}">
    @endif

    @php wp_head() @endphp

    @yield('headerScripts')
    @stack('headerScripts')

    @yield('pageStyles')
    @stack('pageStyles')

    @if(!empty(get_fonts_details()['primaryFontDetails']))
        <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" href="https://fonts.googleapis.com/css?family=<?php echo urlencode(get_fonts_details()['primaryFontDetails']->font)?>:<?php echo urlencode(get_fonts_details()['primaryFontDetails']->regularweight)?>,<?php echo urlencode(get_fonts_details()['primaryFontDetails']->boldweight)?>,<?php echo urlencode(get_fonts_details()['primaryFontDetails']->italicweight)?>">
    @endif

    @if(!empty(get_fonts_details()['secondaryFontDetails']) && get_fonts_details()['primaryFontDetails']->font !== get_fonts_details()['secondaryFontDetails']->font && get_fonts_details()['secondaryFontSwitch'])
        <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" href="https://fonts.googleapis.com/css?family=<?php echo urlencode(get_fonts_details()['secondaryFontDetails']->font)?>:<?php echo urlencode(get_fonts_details()['secondaryFontDetails']->regularweight)?>,<?php echo urlencode(get_fonts_details()['secondaryFontDetails']->boldweight)?>,<?php echo urlencode(get_fonts_details()['secondaryFontDetails']->italicweight)?>">
    @endif
</head>
