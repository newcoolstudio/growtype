@if (class_exists('ACF'))
    @if( have_rows('contacts', $post->ID) )
        <div class="b-acfcontacts">
            @while ( have_rows('contacts', $post->ID) ) @php the_row(); @endphp
            @php
                $is_link = get_sub_field('is_link', $post);
                $type = get_sub_field('type', $post);
                $value = get_sub_field('value', $post);
                $label = get_sub_field('label', $post);
                $link_inner_post = get_sub_field('link_inner_post', $post);
                $external = get_sub_field('external_link', $post) ? 'target="_blank"' : '';
                $icon = get_sub_field('icon', $post);
            @endphp

            @if($type === 'email')
                @php
                    $value = 'mailto:' . $value;
                @endphp
            @elseif($type === 'phone')
                @php
                    $value = 'tel:' . $value;
                @endphp
            @elseif($type === 'address')
                <?php
                $label = '<span>' . esc_html__('Address:', 'growtype') . '</span>' . $label;
                ?>
            @elseif($type === 'person')
                <?php
                $label = '<span>' . esc_html__('Contact person:', 'growtype') . '</span>' . $label;
                ?>
            @endif

            @if(empty($icon))
                @if($type === 'email')
                    @php
                        $icon = '<span class="dashicons dashicons-email"></span>';
                    @endphp
                @elseif($type === 'phone')
                    @php
                        $icon = '<span class="dashicons dashicons-phone"></span>';
                    @endphp
                @elseif($type === 'facebook')
                    @php
                        $icon = '<span class="dashicons dashicons-facebook"></span>';
                    @endphp
                @elseif($type === 'insta')
                    @php
                        $icon = '<span class="dashicons dashicons-instagram"></span>';
                    @endphp
                @elseif($type === 'website')
                    @php
                        $icon = '<span class="dashicons dashicons-admin-site"></span>';
                    @endphp
                @endif
            @endif

            <div class="b-contacts-single" data-type="{!! $type !!}">
                @if($is_link)
                    <a class="btn btn-primary" href="{!! $link_inner_post ? get_permalink($post) : str_replace(' ', '', $value) !!}" {!! $external !!}>
                        {!! $icon ?? null !!}
                        <div class="e-label"><?php echo $label ?></div>
                    </a>
                @else
                    {!! $icon ?? null !!}
                    <div class="e-label"><?php echo $label ?></div>
                @endif
            </div>
            @endwhile
        </div>
    @endif
@endif
