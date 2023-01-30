<?php

/**
 * Woocommerce Product Single Page
 */
$wp_customize->add_section(
    'woocommerce_product_page',
    array (
        'title' => __('Product Single Page', 'growtype'),
        'priority' => 5,
        'panel' => 'woocommerce',
    )
);

/**
 * Access section
 */
$wp_customize->add_setting('woocommerce_product_page_access_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_product_page_access_details',
    array (
        'label' => __('Access'),
        'description' => __('Below you can change access settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Access to product single page
 */
$wp_customize->add_setting('woocommerce_product_page_access_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_access_disabled',
    array (
        'label' => esc_html__('Access disabled', 'growtype'),
        'section' => 'woocommerce_product_page',
        'description' => __('Woocommerce access is disabled', 'growtype'),
    )
));

/**
 * Breadcrumb
 */
$wp_customize->add_setting('woocommerce_product_page_breadcrumb_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_product_page_breadcrumb_details',
    array (
        'label' => __('Breadcrumb'),
        'description' => __('Below you can change breadcrumb settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Breadcrumb status
 */
$wp_customize->add_setting('woocommerce_product_page_breadcrumb_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_breadcrumb_disabled',
    array (
        'label' => esc_html__('Disabled', 'growtype'),
        'section' => 'woocommerce_product_page',
        'description' => __('Woocommerce breadcrumb is disabled', 'growtype'),
    )
));

/**
 * Main IMG
 */
$wp_customize->add_setting('single_page_gallery_main_img',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'single_page_gallery_main_img',
    array (
        'label' => __('Main IMG'),
        'description' => __('Below you can change main IMG settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Width
 */
$wp_customize->add_setting("single_page_gallery_main_img_width", array (
    "default" => "700",
    'type' => 'option',
    'capability' => 'manage_woocommerce',
));

$wp_customize->add_control('single_page_gallery_main_img_width', array (
    'label' => __('Main IMG Width', 'growtype'),
    'description' => __('In pixels', 'growtype'),
    'section' => 'woocommerce_product_page',
    'type' => 'number',
));

/**
 * Height
 */
$wp_customize->add_setting("single_page_gallery_main_img_height", array (
    "default" => "600",
    'type' => 'option',
    'capability' => 'manage_woocommerce',
));

$wp_customize->add_control('single_page_gallery_main_img_height', array (
    'label' => __('Main IMG Height', 'growtype'),
    'description' => __('In pixels', 'growtype'),
    'section' => 'woocommerce_product_page',
    'type' => 'number',
));

/**
 * Cropped
 */
$wp_customize->add_setting('single_page_gallery_main_img_cropped',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'single_page_gallery_main_img_cropped',
    array (
        'label' => esc_html__('Main IMG Cropped'),
        'section' => 'woocommerce_product_page',
        'description' => __('Main IMG is cropped', 'growtype'),
    )
));

/**
 * Gallery
 */
$wp_customize->add_setting('single_page_gallery_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'single_page_gallery_details',
    array (
        'label' => __('Gallery'),
        'description' => __('Below you can change gallery settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Shop gallery type
 */
$wp_customize->add_setting('woocommerce_product_page_gallery_type',
    array (
        'default' => 'woocommerce-product-gallery-type-1',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_product_page_gallery_type',
    array (
        'label' => __('Product Gallery Type', 'growtype'),
        'description' => esc_html__('Choose product gallery type', 'growtype'),
        'section' => 'woocommerce_product_page',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => array (
            'woocommerce-product-gallery-type-1' => __('Type 1', 'growtype'),
            'woocommerce-product-gallery-type-2' => __('Type 2', 'growtype'),
            'woocommerce-product-gallery-type-3' => __('Type 3', 'growtype')
        )
    )
));

/**
 * Adaptive gallery thumbnails height
 */
$wp_customize->add_setting('woocommerce_product_page_gallery_thumbnails_adaptive_height',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_gallery_thumbnails_adaptive_height',
    array (
        'label' => esc_html__('Adaptive thumbnails height'),
        'section' => 'woocommerce_product_page',
        'description' => __('Adaptive gallery thumbnails height', 'growtype'),
    )
));

/**
 * Zoom icon
 */
$wp_customize->add_setting('woocommerce_product_page_gallery_trigger_icon',
    array (
        'default' => 1,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_gallery_trigger_icon',
    array (
        'label' => esc_html__('Image zoom icon'),
        'section' => 'woocommerce_product_page',
        'description' => __('Icon which zooms image', 'growtype'),
    )
));

/**
 * Content
 */
$wp_customize->add_setting('woocommerce_product_page_main_information_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_product_page_main_information_details',
    array (
        'label' => __('Main Information'),
        'description' => __('Below you can change main information settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Payment details
 */
$wp_customize->add_setting('woocommerce_product_page_payment_details',
    array (
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'woocommerce_product_page_payment_details_translation'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'woocommerce_product_page_payment_details',
    array (
        'label' => __('Payment Details'),
        'description' => __('Extra payments information'),
        'section' => 'woocommerce_product_page',
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));

/**
 * Summary position
 */
$wp_customize->add_setting('woocommerce_product_page_excerpt_position',
    array (
        'default' => 'position-1',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_product_page_excerpt_position',
    array (
        'label' => __('Excerpt Position', 'growtype'),
        'description' => esc_html__('Choose product summary/excerpt position', 'growtype'),
        'section' => 'woocommerce_product_page',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => array (
            'position-1' => __('Above "Add to cart"', 'growtype'),
            'position-2' => __('Below "Add to cart"', 'growtype')
        )
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_product_page_description_section_title',
    array (
        'default' => 1,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_description_section_title',
    array (
        'label' => esc_html__('Long Description Title'),
        'section' => 'woocommerce_product_page',
        'description' => __('Enable/disable section title.', 'growtype'),
    )
));

/**
 * Meta data
 */
$wp_customize->add_setting('woocommerce_product_page_meta_data_enabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_meta_data_enabled',
    array (
        'label' => esc_html__('Meta Data Enabled'),
        'section' => 'woocommerce_product_page',
        'description' => __('Enable/disable meta data.', 'growtype'),
    )
));

/**
 * Sale flash
 */
$wp_customize->add_setting('woocommerce_product_page_sale_flash_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_sale_flash_disabled',
    array (
        'label' => esc_html__('Sale flash disabled'),
        'section' => 'woocommerce_product_page',
        'description' => __('Enable/disable sale flash (badge).', 'growtype'),
    )
));

/**
 * Related products
 */
$wp_customize->add_setting('woocommerce_product_page_related_products_notice',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_product_page_related_products_notice',
    array (
        'label' => __('Related Products'),
        'description' => __('Below you can change related products settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Breadcrumb status
 */
$wp_customize->add_setting('woocommerce_product_page_related_products_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_related_products_disabled',
    array (
        'label' => esc_html__('Products Disabled'),
        'section' => 'woocommerce_product_page',
        'description' => __('Related products are disabled.', 'growtype'),
    )
));

/**
 * Products preview style
 */
$wp_customize->add_setting('woocommerce_product_page_related_products_preview_style',
    array (
        'default' => 'grid',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_product_page_related_products_preview_style',
    array (
        'label' => __('Products preview style', 'growtype'),
        'description' => esc_html__('Choose how products should be displayed', 'growtype'),
        'section' => 'woocommerce_product_page',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => $this->product_preview_styles
    )
));

/**
 * Related products amount
 */
$wp_customize->add_setting('woocommerce_product_page_related_products_amount', array (
    'default' => '2',
));

$wp_customize->add_control('woocommerce_product_page_related_products_amount', array (
    'type' => 'text',
    'section' => 'woocommerce_product_page',
    'label' => __('Amount'),
    'description' => __('Related products amount')
));

/**
 * Sidebar
 */
$wp_customize->add_setting('woocommerce_product_page_sidebar_notice',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_product_page_sidebar_notice',
    array (
        'label' => __('Sidebar'),
        'description' => __('Below you can change sidebar settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Sidebar enabled
 */
$wp_customize->add_setting('woocommerce_product_page_sidebar_enabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_sidebar_enabled',
    array (
        'label' => esc_html__('Sidebar Enabled'),
        'section' => 'woocommerce_product_page',
        'description' => __('Sidebar is enabled', 'growtype'),
    )
));

/**
 * Product summary in sidebar
 */
$wp_customize->add_setting('woocommerce_product_page_sidebar_content',
    array (
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'woocommerce_product_page_sidebar_content_translation'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'woocommerce_product_page_sidebar_content',
    array (
        'label' => __('Sidebar Content'),
        'description' => __('Content for product sidebar.'),
        'section' => 'woocommerce_product_page',
        'priority' => 10,
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));
