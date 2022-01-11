<?php
$start_date = get_field('start_date', $post);
$end_date = get_field('end_date', $post);
$expiration_date = !empty($end_date) ? $end_date : $start_date;
?>

<div class="b-preview-wrapper b-activity {!! strtotime($expiration_date) < strtotime(date('Y-m-d H:i:s')) ? 'is-expired' : '' !!}" data-office-title="{!! $office_title ?? null !!}">
    <a href="{!! get_permalink($post) !!}" class="b-preview" style="<?php echo get_featured_image_tag($post) ?>">
        <div class="b-preview-inner">
            @if(!empty($start_date))
                <div class="b-date">
                    <div class="b-date-day">
                        {{date_i18n('d', strtotime($start_date))}}
                    </div>
                    <div class="b-date-month">
                        {{date_i18n('F', strtotime($start_date))}}
                    </div>
                </div>
            @endif
            <div class="b-activity-content">
                <p class="e-title-upper">
                    {!! get_post_meta($post->ID, 'activity_location', true) !!}
                    •
                    {!! date_i18n('H:i', strtotime($start_date)) !!}
                </p>
                <p class="e-title">{{$post->post_title}}</p>
            </div>
        </div>
    </a>
</div>
