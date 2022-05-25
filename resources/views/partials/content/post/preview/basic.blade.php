<?php
$post = isset($post) ? $post : get_post();
$terms = wp_get_post_terms($post->ID, 'service_tax');

$start_date = get_field('start_date', $post);
$end_date = get_field('end_date', $post);
$expiration_date = !empty($end_date) ? $end_date : $start_date;

$post_is_expired = !empty($expiration_date) && strtotime($expiration_date) < strtotime(date('Y-m-d H:i:s')) ? 'is-expired' : '';

$post_classes_list = ['b-post-single'];

if (isset($extra_class) && !empty($extra_class)) {
    array_push($post_classes_list, $extra_class);
}

if (isset($post_is_expired) && !empty($post_is_expired)) {
    array_push($post_classes_list, $post_is_expired);
}

$post_classes = implode(' ', $post_classes_list);

$location = get_post_meta($post->ID, 'location', true);
?>

@if(isset($post_link) && $post_link === false)
    <div class="{!! $post_classes !!}">
        @else
            <a href="{{get_permalink($post->ID)}}" class="{!! $post_classes !!}" data-cat="{!! !empty($terms) ? implode(',',array_pluck($terms,'slug')) : '' !!}">
                @endif
                <div class="b-post-single-inner">
                    @if(!empty(get_featured_image_tag($post, 'medium')))
                        <div class="e-img" style="<?php echo get_featured_image_tag($post, 'medium') ?>">
                            @if(!empty($expiration_date))
                                <div class="b-date">
                                    <div class="b-date-month">
                                        {{date_i18n('F', strtotime($start_date))}}
                                    </div>
                                    <div class="b-date-day">
                                        {{date_i18n('d', strtotime($start_date))}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="b-content">
                        <p class="e-title-upper">
                            <span>{!! !empty($expiration_date) ? $expiration_date : get_the_date() !!}</span>
                            @if(!empty($location))
                                <span class="e-separator">@</span>
                                <span>{!! $location !!}</span>
                            @endif
                        </p>
                        @if(!empty($post->post_title))
                            <h4>{!! $post->post_title !!}</h4>
                        @endif
                        @if(!empty($post->post_excerpt))
                            <p>{{$post->post_excerpt}}</p>
                        @endif
                        <div class="e-intro">
                            @if(isset($content_length) && $content_length === -1)
                                {!! $post->post_content !!}
                            @else
                                {{Growtype_Post::content_limited($post->post_content, isset($content_length) ? $content_length : 200)}}
                            @endif
                        </div>
                    </div>
                    <div class="b-actions">
                        <button class="btn btn-primary">
                            <?php echo isset($cta_label) ? $cta_label : __('Continue reading', 'growtype'); ?>
                        </button>
                    </div>
                </div>
            @if(isset($post_link) && $post_link === false)
    </div>
    @else
    </a>
@endif
