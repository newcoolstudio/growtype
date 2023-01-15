<?php
/**
 * Product Categories Widget
 *
 * @package WooCommerce\Widgets
 * @version 2.3.0
 */

defined('ABSPATH') || exit;

/**
 * Product categories widget class.
 *
 * @extends WC_Widget
 */
class Custom_WC_Widget_Product_Categories extends WC_Widget
{

    /**
     * Category ancestors.
     *
     * @var array
     */
    public $cat_ancestors;

    /**
     * Current Category.
     *
     * @var bool
     */
    public $current_cat;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'woocommerce widget_product_categories';
        $this->widget_description = __('A list or dropdown of product categories.', 'growtype');
        $this->widget_id = 'woocommerce_product_categories';
        $this->widget_name = __('Growtype - Filter Products by Category', 'growtype');
        $this->settings = array (
            'title' => array (
                'type' => 'text',
                'std' => __('Product categories', 'growtype'),
                'label' => __('Title', 'growtype'),
            ),
            'orderby' => array (
                'type' => 'select',
                'std' => 'name',
                'label' => __('Order by', 'growtype'),
                'options' => array (
                    'menu_order' => __('Menu order', 'growtype'),
                    'name' => __('Name', 'growtype'),
                ),
            ),
            'dropdown' => array (
                'type' => 'checkbox',
                'std' => 0,
                'label' => __('Show as dropdown', 'growtype'),
            ),
            'count' => array (
                'type' => 'checkbox',
                'std' => 0,
                'label' => __('Show product counts', 'growtype'),
            ),
            'hierarchical' => array (
                'type' => 'checkbox',
                'std' => 1,
                'label' => __('Show hierarchy', 'growtype'),
            ),
            'show_children_only' => array (
                'type' => 'checkbox',
                'std' => 0,
                'label' => __('Only show children of the current category', 'growtype'),
            ),
            'hide_empty' => array (
                'type' => 'checkbox',
                'std' => 0,
                'label' => __('Hide empty categories', 'growtype'),
            ),
            'hide_uncategorized' => array (
                'type' => 'checkbox',
                'std' => 0,
                'label' => __('Hide uncategorized', 'growtype'),
            ),
            'allow_multiple' => array (
                'type' => 'checkbox',
                'std' => 0,
                'label' => __('Allow multiple categories', 'growtype'),
            ),
            'multiple_include_parent' => array (
                'type' => 'checkbox',
                'std' => 0,
                'label' => __('Multiple categories include parent category', 'growtype'),
            ),
            'allow_children_collapse' => array (
                'type' => 'checkbox',
                'std' => 0,
                'label' => __('Allow children elements collapse', 'growtype'),
            ),
            'max_depth' => array (
                'type' => 'text',
                'std' => '',
                'label' => __('Maximum depth', 'growtype'),
            ),
        );

        parent::__construct();
    }

    /**
     * Output widget.
     *
     * @param array $args Widget arguments.
     * @param array $instance Widget instance.
     * @see WP_Widget
     */
    public function widget($args, $instance)
    {
        global $wp_query, $post;

        $count = isset($instance['count']) ? $instance['count'] : $this->settings['count']['std'];
        $hierarchical = isset($instance['hierarchical']) ? $instance['hierarchical'] : $this->settings['hierarchical']['std'];
        $show_children_only = isset($instance['show_children_only']) ? $instance['show_children_only'] : $this->settings['show_children_only']['std'];
        $dropdown = isset($instance['dropdown']) ? $instance['dropdown'] : $this->settings['dropdown']['std'];
        $orderby = isset($instance['orderby']) ? $instance['orderby'] : $this->settings['orderby']['std'];
        $hide_uncategorized = isset($instance['hide_uncategorized']) ? $instance['hide_uncategorized'] : $this->settings['hide_uncategorized']['std'];
        $hide_empty = isset($instance['hide_empty']) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
        $allow_multiple = isset($instance['allow_multiple']) ? $instance['allow_multiple'] : $this->settings['allow_multiple']['std'];
        $multiple_include_parent = isset($instance['multiple_include_parent']) ? $instance['multiple_include_parent'] : $this->settings['multiple_include_parent']['std'];
        $allow_children_collapse = isset($instance['allow_children_collapse']) && $instance['allow_children_collapse'] ? true : false;
        $dropdown_args = array (
            'hide_empty' => $hide_empty,
        );
        $list_args = array (
            'show_count' => $count,
            'hierarchical' => $hierarchical,
            'taxonomy' => 'product_cat',
            'hide_empty' => $hide_empty,
        );
        $max_depth = absint(isset($instance['max_depth']) ? $instance['max_depth'] : $this->settings['max_depth']['std']);

        $list_args['menu_order'] = false;
        $dropdown_args['depth'] = $max_depth;
        $list_args['depth'] = $max_depth;

        if ('menu_order' === $orderby) {
            $list_args['menu_order'] = true;
        }

        if ($hide_uncategorized) {
            $uncategorized = get_option('default_product_cat');
            $list_args['exclude'] = $uncategorized;
        }

        $this->current_cat = false;
        $this->cat_ancestors = array ();

        if (is_tax('product_cat')) {
            $this->current_cat = $wp_query->queried_object;
            $this->cat_ancestors = get_ancestors($this->current_cat->term_id, 'product_cat');

        } elseif (is_singular('product')) {
            $terms = wc_get_product_terms(
                $post->ID,
                'product_cat',
                apply_filters(
                    'woocommerce_product_categories_widget_product_terms_args',
                    array (
                        'orderby' => 'parent',
                        'order' => 'DESC',
                    )
                )
            );

            if ($terms) {
                $main_term = apply_filters('woocommerce_product_categories_widget_main_term', $terms[0], $terms);
                $this->current_cat = $main_term;
                $this->cat_ancestors = get_ancestors($main_term->term_id, 'product_cat');
            }
        }

        // Show Siblings and Children Only.
        if ($show_children_only && $this->current_cat) {
            if ($hierarchical) {
                $include = array_merge(
                    $this->cat_ancestors,
                    array ($this->current_cat->term_id),
                    get_terms(
                        'product_cat',
                        array (
                            'fields' => 'ids',
                            'parent' => 0,
                            'hierarchical' => true,
                            'hide_empty' => false,
                        )
                    ),
                    get_terms(
                        'product_cat',
                        array (
                            'fields' => 'ids',
                            'parent' => $this->current_cat->term_id,
                            'hierarchical' => true,
                            'hide_empty' => false,
                        )
                    )
                );
                // Gather siblings of ancestors.
                if ($this->cat_ancestors) {
                    foreach ($this->cat_ancestors as $ancestor) {
                        $include = array_merge(
                            $include,
                            get_terms(
                                'product_cat',
                                array (
                                    'fields' => 'ids',
                                    'parent' => $ancestor,
                                    'hierarchical' => false,
                                    'hide_empty' => false,
                                )
                            )
                        );
                    }
                }
            } else {
                // Direct children.
                $include = get_terms(
                    'product_cat',
                    array (
                        'fields' => 'ids',
                        'parent' => $this->current_cat->term_id,
                        'hierarchical' => true,
                        'hide_empty' => false,
                    )
                );
            }

            $list_args['include'] = implode(',', $include);
            $dropdown_args['include'] = $list_args['include'];

            if (empty($include)) {
                return;
            }
        } elseif ($show_children_only) {
            $dropdown_args['depth'] = 1;
            $dropdown_args['child_of'] = 0;
            $dropdown_args['hierarchical'] = 1;
            $list_args['depth'] = 1;
            $list_args['child_of'] = 0;
            $list_args['hierarchical'] = 1;
        }

        $this->widget_start($args, $instance);

        if ($dropdown) {
            wc_product_dropdown_categories(
                apply_filters(
                    'woocommerce_product_categories_widget_dropdown_args',
                    wp_parse_args(
                        $dropdown_args,
                        array (
                            'show_count' => $count,
                            'hierarchical' => $hierarchical,
                            'show_uncategorized' => 0,
                            'selected' => $this->current_cat ? $this->current_cat->slug : '',
                        )
                    )
                )
            );

            wp_enqueue_script('selectWoo');
            wp_enqueue_style('select2');

            wc_enqueue_js(
                "
				jQuery( '.dropdown_product_cat' ).on( 'change', function() {
					if ( jQuery(this).val() != '' ) {
						var this_page = '';
						var home_url  = '" . esc_js(home_url('/')) . "';
						if ( home_url.indexOf( '?' ) > 0 ) {
							this_page = home_url + '&product_cat=' + jQuery(this).val();
						} else {
							this_page = home_url + '?product_cat=' + jQuery(this).val();
						}
						location.href = this_page;
					} else {
						location.href = '" . esc_js(wc_get_page_permalink('shop')) . "';
					}
				});

				if ( jQuery().selectWoo ) {
					var wc_product_cat_select = function() {
						jQuery( '.dropdown_product_cat' ).selectWoo( {
							placeholder: '" . esc_js(__('Select a category', 'growtype')) . "',
							minimumResultsForSearch: 5,
							width: '100%',
							allowClear: true,
							language: {
								noResults: function() {
									return '" . esc_js(_x('No matches found', 'enhanced select', 'growtype')) . "';
								}
							}
						} );
					};
					wc_product_cat_select();
				}
			"
            );
        } else {
            include_once WC()->plugin_path() . '/includes/walkers/class-wc-product-cat-list-walker.php';

            $list_args['walker'] = new WC_Product_Cat_List_Walker();
            $list_args['title_li'] = '';
            $list_args['pad_counts'] = 1;
            $list_args['show_option_none'] = __('No product categories exist.', 'growtype');
            $list_args['current_category'] = ($this->current_cat) ? $this->current_cat->term_id : '';
            $list_args['current_category_ancestors'] = $this->cat_ancestors;
            $list_args['max_depth'] = $max_depth;

            echo '<ul class="product-categories" data-children-collapse="' . ($allow_children_collapse ? 'true' : 'false') . '" data-multiple="' . ($allow_multiple ? 'true' : 'false') . '" data-multiple-include-parent="' . ($multiple_include_parent ? 'true' : 'false') . '">';

            wp_list_categories(apply_filters('woocommerce_product_categories_widget_args', $list_args));

            echo '</ul>';

            if ($allow_multiple) {
                echo '<button class="btn btn-sm btn-clear-cat-filter mt-3">' . __('Clear selected options', 'growtype') . '</button>';
            }
        }

        $this->widget_end($args);
    }
}
