<?php

class Growtype_Extended_Cpt
{
    public function __construct()
    {
        $this->load_admin();
        $this->load_methods();
    }

    /**
     * @return array[]
     */
    public static function get_keys()
    {
        $default_options = self::get_default_options();

        return [
            [
                'name' => 'Cpt 1',
                'value' => 'cpt_1',
                'options' => $default_options
            ],
            [
                'name' => 'Cpt 2',
                'value' => 'cpt_2',
                'options' => $default_options
            ],
            [
                'name' => 'Cpt 3',
                'value' => 'cpt_3',
                'options' => $default_options
            ],
            [
                'name' => 'Cpt 4',
                'value' => 'cpt_4',
                'options' => $default_options
            ],
            [
                'name' => 'Cpt 5',
                'value' => 'cpt_5',
                'options' => $default_options
            ]
        ];
    }

    /**
     * @return string[][]
     */
    public static function get_default_options()
    {
        return [
            [
                'title' => 'Enabled',
                'name' => 'enabled',
                'type' => 'checkbox',
                'default_value' => ''
            ],
            [
                'title' => 'Value',
                'name' => 'value'
            ],
            [
                'title' => 'Label',
                'name' => 'label',
            ],
            [
                'title' => 'Slug',
                'name' => 'slug'
            ],
            [
                'title' => 'Archive Enabled',
                'name' => 'archive_enabled',
                'type' => 'checkbox'
            ],
            [
                'title' => 'Single Page Enabled',
                'name' => 'single_page_enabled',
                'type' => 'checkbox'
            ],
            [
                'title' => 'Tags Enabled (Same tags for posts)',
                'name' => 'tags_enabled',
                'type' => 'checkbox'
            ]
        ];
    }

    /**
     * @return array
     */
    public static function get_active_post_types()
    {
        $keys = self::get_keys();

        $active_pt = [];
        foreach ($keys as $key) {
            if (isset($key['value'])) {
                $enabled = get_option($key['value'] . '_enabled');
                $value = get_option($key['value'] . '_value');
                $label = get_option($key['value'] . '_label');

                if ($enabled && !empty($value)) {
                    $active_pt[] = [
                        'label' => $label,
                        'value' => $value
                    ];
                }
            }
        }

        return $active_pt;
    }

    /**
     *
     */
    private function load_admin()
    {
        require_once dirname(__DIR__) . '/admin/class-growtype-extended-cpt-admin.php';

        new Growtype_Extended_Cpt_Admin();
    }

    /**
     * Cpt register
     */
    private function load_methods()
    {
        require_once dirname(__DIR__) . '/methods/class-growtype-extended-cpt-init.php';

        new Growtype_Extended_Cpt_Init();
    }
}
