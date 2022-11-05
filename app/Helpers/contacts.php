<?php

if (!function_exists('growtype_get_icon')) {
    function growtype_get_icon($type, $label = null, $value = null, $is_link = false, $icon = null)
    {
        if ($type === 'email') {
            $value = 'mailto:' . $value;
            if (empty($icon)) {
                $icon = '<span class="dashicons dashicons-email"></span>';
            }
        } elseif ($type === 'phone') {
            $value = 'tel:' . $value;
            if (empty($icon)) {
                $icon = '<span class="dashicons dashicons-phone"></span>';
            }
        } elseif ($type === 'address') {
            $icon = '<span class="dashicons dashicons-admin-home"></span>';
        } elseif ($type === 'facebook') {
            $icon = '<span class="dashicons dashicons-facebook"></span>';
        } elseif ($type === 'instagram') {
            $icon = '<span class="dashicons dashicons-instagram"></span>';
        } elseif ($type === 'website') {
            $icon = '<span class="dashicons dashicons-admin-site"></span>';
        } elseif ($type === 'work_hours') {
            $icon = '<span class="dashicons dashicons-clock"></span>';
        } elseif ($type === 'marker') {
            $icon = '<span class="dashicons dashicons-location"></span>';
        }

        ?>

        <div class="b-contacts-single" data-type="<?php echo $type ?>">
            <?php if ($is_link) { ?>
                <a class="e-link" href="<?php echo str_replace(' ', '', $value) ?>" target="_blank">
                    <?php if (!empty($icon)) { ?>
                        <span class="e-icon"><?php echo $icon ?></span>
                    <?php } ?>
                    <?php if (!empty($label)) { ?>
                        <div class="e-label"><?php echo $label ?></div>
                    <?php } ?>
                </a>
            <?php } else { ?>
                <?php if (!empty($icon)) { ?>
                    <span class="e-icon"><?php echo $icon ?></span>
                <?php } ?>
                <?php if (!empty($label)) { ?>
                    <div class="e-label"><?php echo $label ?></div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php
    }
}
