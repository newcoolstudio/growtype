<?php

/** Do not allow directly accessing this file. */
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * Class Menu_Icon
 */
class Growtype_Nav_Item_Params
{
    protected static $fields = array ();

    /**
     * Initialize
     */
    public static function init()
    {
        add_action('wp_nav_menu_item_custom_fields', array (__CLASS__, '_fields'), 10, 4);
        add_action('wp_update_nav_menu_item', array (__CLASS__, '_save'), 10, 3);
        add_filter('manage_nav-menus_columns', array (__CLASS__, '_columns'), 99);

        self::$fields = array (
            'icon-class' => [
                'label' => esc_html__('Icon Class', 'growtype'),
                'type' => 'text',
            ],
            'icon-html' => [
                'label' => esc_html__('Icon HTML', 'growtype'),
                'type' => 'text',
            ],
            'custom-attributes' => [
                'label' => esc_html__('Custom Attributes', 'growtype'),
                'type' => 'text',
            ],
            'custom-html' => [
                'label' => esc_html__('Custom HTML', 'growtype'),
                'type' => 'textarea',
            ],
        );
    }

    /**
     * Save custom field value
     *
     * @wp_hook action wp_update_nav_menu_item
     *
     * @param int $menu_id Nav menu ID.
     * @param int $menu_item_db_id Menu item ID.
     * @param array $menu_item_args Menu item data.
     */
    public static function _save($menu_id, $menu_item_db_id, $menu_item_args)
    {
        if (defined('DOING_AJAX') && DOING_AJAX) {
            return;
        }

        check_admin_referer('update-nav_menu', 'update-nav-menu-nonce');

        foreach (self::$fields as $_key => $element) {
            $key = sprintf('menu-item-%s', $_key);

            if (!empty($_POST[$key][$menu_item_db_id])) {
                $value = $_POST[$key][$menu_item_db_id];
            } else {
                $value = null;
            }

            if (!is_null($value)) {
                update_post_meta($menu_item_db_id, $key, $value);
            } else {
                delete_post_meta($menu_item_db_id, $key);
            }
        }
    }


    /**
     * @param $id
     * @param $item
     * @param $depth
     * @param $args
     * @return void
     */
    public static function _fields($id, $item, $depth, $args)
    {
        foreach (self::$fields as $_key => $element) :
            $key = sprintf('menu-item-%s', $_key);
            $id = sprintf('edit-%s-%s', $key, $item->ID);
            $name = sprintf('%s[%s]', $key, $item->ID);
            $value = get_post_meta($item->ID, $key, true);
            $class = sprintf('field-%s', $_key);
            ?>
            <p class="description description-wide <?php echo esc_attr($class); ?>">
                <?php
                if ($element['type'] === 'textarea') {
                    printf(
                        '<label for="%1$s">%2$s<br /><textarea id="%1$s" name="%3$s" style="%4$s" cols="30" rows="5">%5$s</textarea>',
                        esc_attr($id),
                        esc_html($element['label']),
                        esc_attr($name),
                        'width: 100%!important;',
                        esc_attr($value)
                    );
                } else {
                    printf(
                        '<label for="%1$s">%2$s<br /><input type="text" id="%1$s" class="widefat %1$s" name="%3$s" value="%4$s" /></label>',
                        esc_attr($id),
                        esc_html($element['label']),
                        esc_attr($name),
                        esc_attr($value)
                    );
                }
                ?>
            </p>
        <?php
        endforeach;
    }

    /**
     * Add our fields to the screen options toggle
     *
     * @param array $columns Menu item columns.
     * @return array
     */
    public static function _columns($columns)
    {
        $columns = array_merge($columns, self::$fields);

        return $columns;
    }
}

Growtype_Nav_Item_Params::init();
