@php
    $intro_content = get_sub_field('intro_content');
    $postsToDisplay = get_sub_field('posts_to_display');
    $is_slider = get_sub_field('is_slider');
    $contact_details = get_sub_field('contact_details');
    $margin_top = get_sub_field('margin_top');
    $margin_bottom = get_sub_field('margin_bottom');
    $block_style = get_sub_field('block_style');
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
@endphp

<section {!! !empty($unique_id) ? 'id="'.$unique_id.'"' : '' !!} class="section container s-projects s-projects-{{$block_style}}" style="margin-top: {{$margin_top}}px;margin-bottom: {{$margin_bottom}}px;">

    @if (!empty($intro_content))
        <div class="b-intro-content">
            {!! $intro_content !!}
        </div>
    @endif

    @if (!empty($postsToDisplay))
        <div class="b-projects">
            <div class="b-projects-inner {{$is_slider == true ? 'is-slider-projects' : ''}}">
                @foreach ($postsToDisplay as $index => $post)
                    @if($index >= 6)
                        @php
                            continue;
                        @endphp
                    @endif
                            <?php
                            if (function_exists('growtype_post_render_all')) {
                                echo growtype_post_render_all($postsToDisplay, [
                                    'preview_style' => 'basic',
                                    'columns' => 3,
                                    'post_link' => true
                                ]);
                            }
                            ?>
                @endforeach
            </div>
        </div>

        @if(count($postsToDisplay) > 6)
            <div class="text-center pt-3 pb-4">
                <a href="{{get_post_type_archive_link('projects')}}" class="btn btn-block btn-secondary mx-auto" style="max-width: 300px;"><?php echo __('See all',
                        'growtype')?></a>
            </div>
        @endif

    @endif

</section>
