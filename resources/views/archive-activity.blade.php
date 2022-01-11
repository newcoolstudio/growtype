@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    <h2 class="text-center pb-4"><?php echo __('Activities', 'growtype') ?></h2>
    <div class="container">
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
            @php($post = get_post())
            @include('partials.content.activity.preview.basic')
            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection

@section('footerScripts')
@endsection

