<!doctype html>
<html {!! get_language_attributes() !!}>

@include('partials.sections.head')

<body @php body_class($body_class ?? null) @endphp role="document">

<?php wp_body_open(); ?>

@php do_action('get_header') @endphp

@yield('header')

<div class="main-content-wrapper">
    {{--Alert--}}
    @include('partials.components.alert.index')

    {{--User panel--}}
    @if(growtype_display_panel())
        @yield('panel')
    @endif

    {{--Sidebar--}}
    @yield('sidebar')

    <main id="main" class="<?php echo growtype_get_main_container_classes() ?>" role="main">
        <?php do_action('growtype_after_main_content_open') ?>

        {{--Search--}}
        @include('partials.components.search.index')

        {{--Main content--}}
        @yield('content')

        <?php do_action('growtype_before_main_content_close') ?>
    </main>
</div>

{{--Modal--}}
@include('partials.components.modal.index')

@yield('footer')

@php do_action('get_footer') @endphp
@php wp_footer() @endphp

@yield('footerScripts')
@stack('footerScripts')

</body>
</html>
