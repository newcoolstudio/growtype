<!doctype html>
<html {!! get_language_attributes() !!}>

@include('partials.sections.head')

<body @php body_class($body_class ?? null) @endphp role="document">

<?php wp_body_open(); ?>

@php do_action('get_header') @endphp

@yield('header')

<div class="main-content-wrapper">
    {{--Modal--}}
    @include('partials.components.modal.index')

    {{--Alert--}}
    @include('partials.components.alert.index')

    {{--User panel--}}
    @if(growtype_display_panel())
        @yield('panel')
    @endif

    {{--Sidebar--}}
    @yield('sidebar')

    <main id="main" class="<?php echo growtype_get_main_container_classes() ?>" role="main">
        {{--Search--}}
        @include('partials.components.search.index')

        {{--Main content--}}
        @yield('content')
    </main>
</div>

@yield('footer')

@php do_action('get_footer') @endphp
@php wp_footer() @endphp

@yield('footerScripts')
@stack('footerScripts')

</body>
</html>
