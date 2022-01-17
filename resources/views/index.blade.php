@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    <section class="section s-content">
        <div class="container">
            @if (!have_posts())
                <div class="alert alert-warning">
                    <?php echo __('Sorry, no results were found.', 'growtype') ?>
                </div>
                {!! get_search_form(false) !!}
            @endif

            <div class="b-posts">
                @while (have_posts()) @php the_post() @endphp
                @include('partials.content.content-'.get_post_type())
                @endwhile
            </div>

            <nav class="pagination pagination-posts">
                {!! growtype_get_pagination() !!}
            </nav>
        </div>
    </section>
@endsection

@section('panel')
    @include('partials.content.content-panel')
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
