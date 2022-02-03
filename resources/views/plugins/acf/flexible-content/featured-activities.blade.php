@php
    $intro_content = get_sub_field('intro_content');
    $postsToDisplay = get_sub_field('posts_to_display') ?? null;
    $is_slider = get_sub_field('is_slider');
    $is_disabled = get_sub_field('is_disabled') ?? false;
    $contact_details = get_sub_field('contact_details');
    $margin_top = get_sub_field('margin_top');
    $margin_bottom = get_sub_field('margin_bottom');
    $block_style = get_sub_field('block_style');
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
@endphp

@if(empty($postsToDisplay))
    @php
        $postsToDisplay = Growtype_Post::ordered_by_start_time(3);
    @endphp
@endif

@if(!$is_disabled && isset($postsToDisplay) && !empty($postsToDisplay))
    <section {!! !empty($unique_id) ? 'id="'.$unique_id.'"' : '' !!} class="section s-activities s-activities-{{$block_style}} "
             style="margin-top: {{$margin_top}}px;margin-bottom: {{$margin_bottom}}px;"
             data-posts-amount="{!! count($postsToDisplay) !!}"
    >
        <div class="container">
            @if (!empty($intro_content))
                <div class="b-intro-content">
                    {!! $intro_content !!}
                </div>
            @endif

            @if(!empty($postsToDisplay))
                <div class="b-activities">
                    <div class="row b-activities-inner {{$is_slider == true ? 'is-slider-activities' : ''}}">
                        @foreach ($postsToDisplay as $index => $post)
                            @include('partials.content.activity.preview.basic')
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="text-center mt-4">
                <a href="{!! get_permalink(1061) !!}" class="btn btn-secondary"><?php echo __('Show more', 'growtype') ?></a>
            </div>
        </div>
    </section>
@endif
