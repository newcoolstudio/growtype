<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;
?>
<div class="product_meta">

    <?php do_action('woocommerce_product_meta_start'); ?>

    <?php if ( wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable')) ) : ?>

    <span class="sku_wrapper"><?php esc_html_e('SKU:',
            'growtype'); ?> <span class="sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A',
                'growtype'); ?></span></span>

    <?php endif; ?>

    <?php
    $product_creator_id = $product->get_meta('_product_creator_id');
    $author_details = null;

    if (!empty($product_creator_id)) {
        $author = get_user_by('id', $product_creator_id);
        $author_details = $author->data->user_nicename;

        if (class_exists('Buddypress')) {
            $author_details = '<a href="' . bp_core_get_user_domain($product_creator_id) . '">' . $author_details . '</a>';
        }
    }
    ?>

        @if(!empty($author_details))
            <div class="cat-parent">
                <?php esc_html_e('Author', 'growtype') ?>
            </div>
            <div class="cat-parent">
                <span>{!! $author_details !!}</span>
            </div>
        @endif

    <?php
    $parents = wp_get_post_terms($product->get_id(), 'product_cat', array ('parent' => 0, 'hide_empty' => 0));

    foreach ($parents as $parent) {

    $children = get_terms(array (
        'object_ids' => [$product->get_id()],
        'taxonomy' => 'product_cat', // you could also use $taxonomy as defined in the first lines
        'child_of' => $parent->term_id,
        'hide_empty' => true,
    ));
    ?>

    <div class="cat-parent">{!! $parent->name !!}</div>
    <div class="cat-children">
        <?php
        foreach ($children as $key => $child) { ?>
        <span>
            {!! $child->name !!}{!! count($children) - 1 === $key ? '' : ',' !!}
        </span>
        <?php }
        ?>
    </div>

    <?php } ?>

    <?php do_action('woocommerce_product_meta_end'); ?>

</div>
