@if(class_exists('ACF') && have_rows('details', get_the_ID()))
    <div class="b-product-details">
        <h3 class="e-title-section">{{__('Product information','growtype')}}</h3>
        <ul class="b-list mt-3 m-<?php echo get_field('type')?>">
            <?php
            while (have_rows('details', get_the_ID())) : the_row();
            $label = get_sub_field('label');
            $value = get_sub_field('value');
            $value_basic = get_sub_field('value_basic');
            ?>
            <li class="b-list-single">
                <div class="e-label">{!! $label !!}</div>
                <div class="e-value">{!! get_field('type') === 'basic' ? $value_basic : $value !!}</div>
            </li>
            <?php
            endwhile;
            ?>
        </ul>
    </div>
@endif
