@php
    $tab_accordion = get_sub_field('accordion');
    $intro_content = get_sub_field('intro_content');
    $type = get_sub_field('type');
    $block_style = get_sub_field('block_style');
    $unique_id = !empty(get_sub_field('unique_id_is_not_f_editable')) ? str_replace(' ', '_', get_sub_field('unique_id_is_not_f_editable')) : '';
@endphp

<section id="{{$unique_id}}" class="section s-accordion s-accordion-{{$block_style}}">
    <div class="container">
        @if(!empty($intro_content))
            <h2 class="e-title-intro">{!! $intro_content !!}</h2>
        @endif

        <div class="b-accordion b-accordion-{!! $type !!}">
            @if($type === 'horizontal')
                <div class="b-accordion-nav">
                    <?php
                    if (have_rows('accordion')):
                    $i = 0;
                    while (have_rows('accordion')) : the_row();

                    $contact_title = get_sub_field('title');
                    $contact_content = get_sub_field('content');
                    ?>
                    <div class="b-accordion--tab <?php if ($i === 0): echo 'is-active'; endif; ?>" data-nr="<?php echo $i ?>"><?php echo $contact_title ?></div>
                    <?php
                    $i++;
                    endwhile;
                    endif; ?>
                </div>
                <div class="b-accordion-main">
                    <?php
                    if (have_rows('accordion')):
                    $i = 0;
                    while (have_rows('accordion')) : the_row();

                    $contact_title = get_sub_field('title');
                    $contact_content = get_sub_field('content');
                    ?>
                    <div class="b-accordion--content <?php if ($i === 0): echo 'is-active'; endif; ?>" data-nr="<?php echo $i ?>">
                        <?php echo $contact_content ?>
                    </div>
                    <?php
                    $i++;
                    endwhile;
                    endif; ?>
                </div>
            @else
                <?php
                if (have_rows('accordion')):
                $i = 0;
                while (have_rows('accordion')) : the_row();

                $contact_title = get_sub_field('title');
                $contact_content = get_sub_field('content');
                ?>
                <div class="b-accordion--tab <?php if ($i === 0): echo 'is-active'; endif; ?>" data-nr="<?php echo $i ?>">
                    <?php echo $contact_title ?>
                    <div class="e-arrow m-plus">+</div>
                    <div class="e-arrow m-minus">-</div>
                </div>
                <div class="b-accordion--content <?php if ($i === 0): echo 'is-active'; endif; ?>" data-nr="<?php echo $i ?>">
                    <?php echo $contact_content ?>
                </div>
                <?php
                $i++;
                endwhile;
                endif; ?>
            @endif
        </div>
    </div>
</section>
