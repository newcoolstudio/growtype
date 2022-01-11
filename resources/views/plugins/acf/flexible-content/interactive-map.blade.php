@php
    $mapField = get_sub_field('map_preview');
    $margin_top = get_sub_field('margin_top');
    $margin_bottom = get_sub_field('margin_bottom');
@endphp

<section class="section b-map is-ready" style="margin-top: <?php echo $margin_top ?>px;margin-bottom: <?php echo $margin_bottom ?>px">
    <div class="container">
        @if(!empty(get_the_title()))
            <h2 class="e-title-intro">
                {!! get_the_title() !!}
            </h2>
        @endif
        <div class="b-map-wrapper">
            <?php echo $mapField ?>
        </div>
    </div>
</section>
