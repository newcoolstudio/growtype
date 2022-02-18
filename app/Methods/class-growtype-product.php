<?php

/**
 * Growtype auction methods
 * Requires woocommerce-simple-auction plugin
 */
class Growtype_Product
{
    const KEY_PRICE_PER_UNIT = 'price_per_unit';
    const META_KEY_PRICE_PER_UNIT = '_price_per_unit';

    /**
     * @return mixed
     */
    public static function category_children($category_slug): array
    {
        global $product;

        $terms = wc_get_product_terms($product->get_id(), 'product_cat', ['parent' => false]);

        $parent = array_where($terms, function ($value, $key) use ($category_slug) {
            return $value->slug === $category_slug;
        });

        $parent = array_last($parent);

        if (!empty($parent)) {
            $term_id = $parent->term_id;

            $terms = wc_get_product_terms($product->get_id(), 'product_cat', [
                'child_of' => $term_id
            ]);

            return $terms;
        }

        return [];
    }

    /**
     * @return void
     */
    public static function location_country()
    {
        global $product;

        return get_post_meta($product->get_id(), '_product_location_country', true);
    }

    /**
     * @return void
     */
    public static function location_country_formatted()
    {
        $countries = WC()->countries->get_allowed_countries();

        return !empty(self::location_country()) ? $countries[self::location_country()] : '';
    }

    /**
     * @return void
     */
    public static function location_city()
    {
        global $product;

        return get_post_meta($product->get_id(), '_product_location_city', true);
    }

    /**
     * @param $category_slug
     * @param $value
     * @return string
     */
    public static function category_children_formatted($category_slug, $value = 'name')
    {
        $children_values = array_pluck(self::category_children($category_slug), $value);

        if (!empty($children_values)) {
            return implode(', ', $children_values);
        }

        return '';
    }

    /**
     * @return mixed
     */
    public static function sidebar()
    {
        return get_theme_mod('woocommerce_product_page_sidebar_enabled');
    }

    /**
     * @return mixed
     */
    public static function sidebar_content()
    {
        return get_theme_mod('woocommerce_product_page_sidebar_content');
    }

    /**
     * @param $product
     * @return mixed|string|void
     */
    public static function get_add_to_cart_btn_text($product = null)
    {
        $add_to_cart_button_custom_text = get_theme_mod('woocommerce_product_preview_cta_label');

        if (empty($product)) {
            if (!empty($add_to_cart_button_custom_text)) {
                return $add_to_cart_button_custom_text;
            } else {
                return __('Add to bag', 'growtype');
            }
        }

        $button_text_custom_product = get_post_meta($product->get_id(), '_add_to_cart_button_custom_text', true);

        if (!empty($button_text_custom_product)) {
            $add_to_cart_button_custom_text = $button_text_custom_product;
        }

        return !empty($add_to_cart_button_custom_text) ? $add_to_cart_button_custom_text : __('Add to bag', 'growtype');
    }

    /**
     * @param $products
     * @return bool
     */
    public static function product_is_among_required_products($product_id)
    {
        $must_have_products_list = get_theme_mod('theme_access_user_must_have_products_list');
        $must_have_products_list = !empty($must_have_products_list) ? explode(',', $must_have_products_list) : [];

        return in_array($product_id, $must_have_products_list);
    }

    /**
     * @param $products
     * @return bool
     */
    public static function user_has_bought_required_products($user_id = null)
    {
        $user_id = !empty($user_id) ? $user_id : get_current_user_id();
        $must_have_products = get_theme_mod('theme_access_user_must_have_products');

        if ($must_have_products) {
            $must_have_products_list = get_theme_mod('theme_access_user_must_have_products_list');
            $must_have_products_list = !empty($must_have_products_list) ? explode(',', $must_have_products_list) : null;

            $customer_has_bought_products = Growtype_Product::user_has_bought_wc_products($user_id, $must_have_products_list);

            return $customer_has_bought_products;
        }

        return true;
    }

    /**
     * @param $products_ids
     * @param $user_var
     * @return bool
     */
    public static function user_has_bought_wc_products($user_id, $products_ids, $one_is_enough = true, $user_var = null)
    {
        global $wpdb;

        if (empty($user_var) || is_numeric($user_var)) {
            $meta_key = '_customer_user';
            $meta_value = $user_var ? (int)$user_var : (int)$user_id;
        } else {
            $meta_key = '_billing_email';
            $meta_value = sanitize_email($user_var);
        }

        $paid_statuses_list = class_exists('woocommerce') ? wc_get_is_paid_statuses() : ['completed'];
        $paid_statuses = array_map('esc_sql', $paid_statuses_list);

        $product_ids = is_array($products_ids) ? implode(',', $products_ids) : $products_ids;

        $line_meta_value = $product_ids != (0 || '') ? 'AND woim.meta_value IN (' . $product_ids . ')' : 'AND woim.meta_value != 0';

        /**
         * Number of products
         */
        $count = $wpdb->get_var("
        SELECT COUNT(p.ID) FROM {$wpdb->prefix}posts AS p
        INNER JOIN {$wpdb->prefix}postmeta AS pm ON p.ID = pm.post_id
        INNER JOIN {$wpdb->prefix}woocommerce_order_items AS woi ON p.ID = woi.order_id
        INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS woim ON woi.order_item_id = woim.order_item_id
        WHERE p.post_status IN ( 'wc-" . implode("','wc-", $paid_statuses) . "' )
        AND pm.meta_key = '$meta_key'
        AND pm.meta_value = '$meta_value'
        AND woim.meta_key IN ( '_product_id', '_variation_id' ) $line_meta_value 
    ");

        if ($one_is_enough) {
            return $count > 0 ? true : false;
        }

        return $count === count($product_ids) ? true : false;
    }

    /**
     * @return void
     */
    public static function get_user_purchased_products_ids($user_id = null)
    {
        $user_id = !empty($user_id) ? $user_id : get_current_user_id();

        if (empty($user_id)) {
            return null;
        }

        $customer_orders = get_posts(array (
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'meta_value' => $user_id,
            'post_type' => wc_get_order_types(),
            'post_status' => array_keys(wc_get_is_paid_statuses()),
        ));

        if (!$customer_orders) {
            return null;
        }

        $product_ids = array ();
        foreach ($customer_orders as $customer_order) {
            $order = wc_get_order($customer_order->ID);
            $items = $order->get_items();
            foreach ($items as $item) {
                $product_id = $item->get_product_id();
                $product_ids[] = $product_id;
            }
        }

        $product_ids = !empty($product_ids) ? array_values(array_unique($product_ids)) : null;

        return $product_ids;
    }

    /**
     * @return void
     */
    public static function get_user_uploaded_products_ids($user_id = null)
    {
        $user_id = !empty($user_id) ? $user_id : get_current_user_id();

        if (empty($user_id)) {
            return null;
        }

        $args = array (
            'limit' => -1,
        );

        $products = wc_get_products($args);

        $product_ids = array ();
        foreach ($products as $product) {
            $creator_id = get_post_meta($product->get_id(), '_product_creator_id', true);
            if ($creator_id == $user_id) {
                array_push($product_ids, $product->get_id());
            }
        }

        return !empty($product_ids) ? array_values(array_unique($product_ids)) : null;
    }

    /**
     * @param $product_id
     * @param $user_id
     * @return bool
     */
    public static function user_has_uploaded_product($product_id, $user_id = null)
    {
        $user_id = !empty($user_id) ? $user_id : get_current_user_id();

        if (empty($user_id)) {
            return false;
        }

        $creator_id = (int)get_post_meta($product_id, '_product_creator_id', true);

        return $creator_id === $user_id;
    }

    /**
     * @return bool
     */
    public static function product_preview_cta_disabled()
    {
        return empty(get_theme_mod('woocommerce_product_preview_add_to_cart_btn')) || !get_theme_mod('woocommerce_product_preview_add_to_cart_btn');
    }

    /**
     * @return bool
     */
    public static function amount_in_units($product_id = null)
    {
        global $product;

        if ($product_id) {
            $product = wc_get_product($product_id);
        }

        return get_post_meta($product->get_id(), '_amount_in_units', true);
    }

    /**
     * @return bool
     */
    public static function amount_in_units_formatted()
    {
        if (self::amount_in_units() > 0) {
            return self::amount_in_units() . ' ' . __('units', 'growtype');
        }

        return '';
    }

    /**
     * @return bool
     */
    public static function amount_in_cases($product_id = null)
    {
        global $product;

        $product_id = !empty($product_id) ? $product_id : $product->get_id();

        return get_post_meta($product_id, '_amount_in_cases', true);
    }

    /**
     * @return bool
     */
    public static function cases_per_pallet($product_id = null)
    {
        global $product;

        $product_id = !empty($product_id) ? $product_id : $product->get_id();

        return get_post_meta($product_id, '_cases_per_pallet', true);
    }

    /**
     * @return bool
     */
    public static function volume()
    {
        global $product;

        return get_post_meta($product->get_id(), '_product_volume', true);
    }

    /**
     * @return bool
     */
    public static function volume_formatted()
    {
        return !empty(self::volume()) ? self::volume() . ' ' . __('L', 'growtype') : '';
    }

    /**
     * @return void
     */
    public static function prepare_shipping_documents($file_names, $file_urls, $file_hashes, $file_keys)
    {
        $downloads = array ();

        if (!empty($file_urls)) {
            $file_url_size = count($file_urls);

            for ($i = 0; $i < $file_url_size; $i++) {
                if (!empty($file_urls[$i])) {
                    $downloads[] = array (
                        'name' => wc_clean($file_names[$i]),
                        'url' => wp_unslash(trim($file_urls[$i])),
                        'download_id' => wc_clean($file_hashes[$i]),
                        'key' => wc_clean($file_keys[$i]),
                    );
                }
            }
        }

        return $downloads;
    }

    /**
     * @return mixed
     */
    public static function shipping_documents($product_id = null): array
    {
        global $product;

        $product_id = !empty($product_id) ? $product_id : (!empty($product) ? $product->get_id() : null);

        if (!empty($product_id)) {
            return get_post_meta($product_id, '_shipping_documents', true);
        }

        return [];
    }

    /**
     * @return mixed
     */
    public static function preview_permalink($product_id = null): string
    {
        global $product;

        $product_id = !empty($product_id) ? $product_id : $product->get_id();

        return get_permalink($product_id) . '?customize=preview';
    }

    /**
     * @return mixed
     */
    public static function edit_permalink($product_id = null): string
    {
        global $product;

        $product_id = !empty($product_id) ? $product_id : $product->get_id();

        return get_permalink($product_id) . '?customize=edit';
    }

    /**
     * @return mixed
     */
    public static function permalink($product_id = null): string
    {
        global $product;

        $product_id = !empty($product_id) ? $product_id : $product->get_id();

        /**
         * Check if preview permalink applied
         */
        if (!empty(get_query_var('preview_permalink')) && get_query_var('preview_permalink')) {
            return self::preview_permalink($product_id);
        }

        return get_permalink($product_id);
    }
}
