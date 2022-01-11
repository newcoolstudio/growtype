@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('content')
    <section class="s-member">
        <div class="container">
            <h2 class="e-title-intro"><?php echo __('Members', 'growtype') ?></h2>
            <div class="b-member">
                <div class="row b-member-inner">
                    <?php while ( have_posts() ) : the_post(); ?>
                    @php($post = get_post())
                    @include('partials.content.member.preview.vertical')
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
