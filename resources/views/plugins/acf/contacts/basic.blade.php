@if (class_exists('ACF'))
    @if( have_rows('contacts', $post) )
        <div class="b-acfcontacts">
            @while ( have_rows('contacts', $post) )
                @php the_row(); @endphp
                @php
                    $is_link = get_sub_field('is_link', $post);
                    $type = get_sub_field('type', $post);
                    $value = get_sub_field('value', $post);
                    $label = get_sub_field('label', $post);
                    $link_inner_post = get_sub_field('link_inner_post', $post);
                    $external = get_sub_field('external_link', $post) ? 'target="_blank"' : '';
                    $icon = get_sub_field('icon', $post);
                @endphp

                {!! growtype_get_icon($type, $label, $value, $is_link, $icon) !!}
            @endwhile
        </div>
    @endif
@endif
