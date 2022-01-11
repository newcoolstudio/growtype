@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    <?php
    $terms = get_terms(array (
        'taxonomy' => 'projects_tax',
        'hide_empty' => false,
    ));
    ?>
    <ul class="menu menu-projects d-flex justify-content-center">
        <li class="menu-item pl-2 pr-2" data-type="all">
            <a href="#all"><?php echo __('All', 'growtype') ?></a>
        </li>
        @foreach($terms as $term)
            <li class="menu-item pl-2 pr-2" data-type="{!! $term->slug !!}">
                <a href="#{!! $term->slug !!}">{!! $term->name !!}</a>
            </li>
        @endforeach
    </ul>
    <div class="b-projects">
        <div class="b-projects-inner">
            <?php while ( have_posts() ) : the_post(); ?>
            @php($post = get_post())
            @include('plugins.acf.flexible-content.partials.project-preview')
            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection

@section('footerScripts')
    <script>
        if (window.location.hash.length === 0) {
            $('.menu-projects .menu-item[data-type="all"] a').addClass('is-active');
        } else {
            var cat = window.location.hash.replace('#', '');
            triggerProjectGroup(cat);
        }

        function triggerProjectGroup(cat) {
            $('.menu-projects .menu-item a').removeClass('is-active');
            $('.menu-projects .menu-item[data-type="' + cat + '"] a').addClass('is-active');
            if (cat !== 'all') {
                $('.b-projects .b-project-single').fadeOut().promise().done(function () {
                    $('.b-projects .b-project-single[data-cat="' + cat + '"]').fadeIn();
                });
            } else {
                $('.b-projects .b-project-single').fadeIn();
            }
        }

        $('.menu-projects .menu-item a').click(function () {
            if (!$(this).hasClass('is-active')) {
                triggerProjectGroup($(this).closest('li').attr('data-type'));
            }
        });
    </script>
@endsection

