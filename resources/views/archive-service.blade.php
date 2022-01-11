@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    <section class="s-service">
        <div class="container">
            <h2 class="e-title-intro"><?php echo __('Services', 'growtype') ?></h2>
            <div class="b-service">
                <div class="row b-service-inner">
                    <?php while ( have_posts() ) : the_post(); ?>
                    @php($post = get_post())
                    @include('partials.content.service.preview.basic')
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection

@section('footerScripts')
@endsection

