<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$featured_image_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();
$woocommerce_product_page_gallery_type = !empty(get_theme_mod('woocommerce_product_page_gallery_type')) ? get_theme_mod('woocommerce_product_page_gallery_type') : 'woocommerce-product-gallery-type-2';
$woocommerce_product_page_gallery_thumbnails_adaptive_height = get_theme_mod('woocommerce_product_page_gallery_thumbnails_adaptive_height') ? 'enabled' : 'disabled';
$woocommerce_product_page_gallery_thumbnails_adaptive_height = 'woocommerce-product-gallery-adaptive-height-' . $woocommerce_product_page_gallery_thumbnails_adaptive_height;

$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array (
        'woocommerce-product-gallery',
        $woocommerce_product_page_gallery_type,
        $woocommerce_product_page_gallery_thumbnails_adaptive_height,
        'woocommerce-product-gallery--' . (count($gallery_image_ids) > 0 ? 'with-images' : 'without-images'),
        'woocommerce-product-gallery--columns-' . absint($columns),
        'images',
    )
);
?>

@if($woocommerce_product_page_gallery_type === 'woocommerce-product-gallery-type-3')
    <div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class',
        $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>"
    >
        <div class="woocommerce-product-gallery__wrapper">
            @if ($featured_image_id)
                @php
                    $shop_single_img = wp_get_attachment_metadata( $featured_image_id )['sizes']['shop_single'];
                @endphp

                <div class="img-primary">
                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                        <div class="e-img-wrapper">
                            <a href="{!! wp_get_attachment_url( $featured_image_id ) !!}" class="e-img-wrapper-inner">
                                <div class="wp-post-image" data-index="0" style="background: url('{!! wp_get_attachment_image_url( $featured_image_id , 'medium') !!}');" data-src="{!! wp_get_attachment_url( $featured_image_id ) !!}" data-large_image="{!! wp_get_attachment_url( $featured_image_id ) !!}" data-large_image_width="{!! $shop_single_img['width'] ?? '' !!}" data-large_image_height="{!! $shop_single_img['height'] ?? '' !!}"></div>
                            </a>
                        </div>
                    </figure>
                </div>

                @if (count($gallery_image_ids) > 0)
                    <div class="img-secondary">
                        @foreach($gallery_image_ids as $key => $image_id)
                            <figure style="{!! $key > 1 ? 'display:none;' : '' !!}" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                <div class="e-img-wrapper">
                                    <a href="{!! wp_get_attachment_url( $image_id ) !!}" class="e-img-wrapper-inner">
                                        <div class="wp-post-image" data-index="{!! $key + 1 !!}" style="background: url('{!! wp_get_attachment_image_url( $image_id , 'thumbnail') !!}');" data-src="{!! wp_get_attachment_url( $image_id ) !!}" data-large_image="{!! wp_get_attachment_url( $image_id ) !!}" data-large_image_width="{!! wp_get_attachment_metadata( $image_id )['width'] ?? '' !!}" data-large_image_height="{!! wp_get_attachment_metadata( $image_id )['height'] ?? '' !!}"></div>
                                    </a>
                                </div>
                            </figure>
                        @endforeach
                    </div>
                    @if (count($gallery_image_ids) > 2)
                        <button class="btn btn-gallery" data-index="3">{!! __('Show more photos','growtype') !!}</button>
                    @endif
                @endif
            @else
                @php
                    $html = '<div class="woocommerce-product-gallery__image--placeholder">';
                    $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />',
                        esc_url(wc_placeholder_img_src('woocommerce_single')),
                        esc_html__('Awaiting product image', 'growtype'));
                    $html .= '</div>';
                @endphp
            @endif
        </div>
    </div>
@else
    <div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class',
        $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-thumbnail-width="{{get_woocommerce_product_gallery_sizes()['thumbnail']['width']}}" data-thumbnail-height="{{get_woocommerce_product_gallery_sizes()['thumbnail']['height']}}" style="opacity: 0; transition: opacity .25s ease-in-out;">
        <figure class="woocommerce-product-gallery__wrapper">
            <?php
            if ($featured_image_id) {
                $html = wc_get_gallery_image_html($featured_image_id, true);
            } else {
                $html = '<div class="woocommerce-product-gallery__image--placeholder">';
                $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />',
                    esc_url(wc_placeholder_img_src('woocommerce_single')),
                    esc_html__('Awaiting product image', 'growtype'));
                $html .= '</div>';
            }

            echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html,
                $featured_image_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

            do_action('woocommerce_product_thumbnails');
            ?>
        </figure>
    </div>
@endif
