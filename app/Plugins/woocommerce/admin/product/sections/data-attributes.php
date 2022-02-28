<?php

/**
 *
 */
function growtype_get_attribute_radio($attribute_name)
{
    global $post;
    $val = get_post_meta($post->ID, "attribute_" . $attribute_name . "_radio", true);
    return !empty($val) ? $val : false;
}

/**
 *
 */
add_action('woocommerce_after_product_attribute_settings', 'growtype_woocommerce_after_product_attribute_settings', 10, 1);
function growtype_woocommerce_after_product_attribute_settings($attribute, $i = 0)
{
    $value = !empty(WC()->session) ? WC()->session->get("attribute_" . $attribute->get_name() . "_radio") : growtype_get_attribute_radio($attribute->get_name());
    ?>
    <?php
    global $post;
    ?>
    <tr>
        <td>
            <div class="enable_variation">
                <label>
                    <input type="hidden" name="attribute_<?php echo $attribute->get_name() ?>_radio[<?php echo esc_attr($i); ?>]" value="0"/>
                    <input type="checkbox" class="checkbox" <?php checked($attribute->get_variation(), $value); ?> name="attribute_<?php echo $attribute->get_name() ?>_radio[<?php echo esc_attr($i); ?>]" value="1"/>
                    <?php esc_html_e('Is - radio select', 'growtype'); ?>
                </label>
            </div>
        </td>
    </tr>
    <?php
}

/**
 *
 */
add_action('wp_ajax_woocommerce_save_attributes', 'growtype_wp_ajax_woocommerce_save_attributes', 0);
function growtype_wp_ajax_woocommerce_save_attributes()
{
    check_ajax_referer('save-attributes', 'security');
    parse_str($_POST['data'], $data);
    $post_id = absint($_POST['post_id']);
    foreach ($data['attribute_names'] as $attribute_name) {
        if (array_key_exists("attribute_" . $attribute_name . "_radio", $data) && is_array($data["attribute_" . $attribute_name . "_radio"])) {
            foreach ($data["attribute_" . $attribute_name . "_radio"] as $i => $val) {
                update_post_meta($post_id, "attribute_" . $attribute_name . "_radio", wc_string_to_bool($val));
                WC()->session->set("attribute_" . $attribute_name . "_radio", wc_string_to_bool($val));
            }
        }
    }
}
