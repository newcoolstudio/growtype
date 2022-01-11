@php
    $contact_details = get_sub_field('contact_details');
    $margin_top = get_sub_field('margin_top');
    $margin_bottom = get_sub_field('margin_bottom');
    $contactForm = get_sub_field('select_contact_form');
    $introImage = get_sub_field('intro_image');
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
@endphp

<section {!! !empty($unique_id) ? 'id="'.$unique_id.'"' : '' !!} class="section b-contactdetais" style="margin-top: <?php echo $margin_top ?>px;margin-bottom: <?php echo $margin_bottom ?>px;">
    <div class="container">
        @if(!empty(get_sub_field('intro_content')))
            <div class="b-intro-content">
                {!! get_sub_field('intro_content') !!}
            </div>
        @endif
        <div class="b-contactdetais-maincontent {{!empty($introImage) ? 'with-image' : ''}}">
            @if(!empty($introImage))
                <div class="b-introimage">
                    <img class="img-fluid" src="{{$introImage["url"]}}" alt="">
                </div>
            @endif
            <div class="b-contacts">
                <h3 class="e-title-section"><?php echo get_sub_field('intro_title_contacts') ?></h3>
                <?php
                if (have_rows('contact_details')):
                while (have_rows('contact_details')) : the_row();

                $contact_title = get_sub_field('contact_title');
                $content = get_sub_field('content');
                ?>
                <div class="b-contact-single">
                    <div class="b-contact-inner">
                        <div class="e-title"><?php echo $contact_title ?></div>
                        <div class="e-content"><?php echo $content ?></div>
                    </div>
                </div>
                <?php
                endwhile;
                endif;
                ?>
            </div>
            @if(!empty($contactForm))
                <div class="b-contactform">
                    <h3 class="e-title-section"><?php echo get_sub_field('intro_title_contact_form') ?></h3>
                    {!! do_shortcode('[contact-form-7 id="' . $contactForm->ID . '"]'); !!}
                </div>
            @endif
        </div>
    </div>
</section>
