function productGalleryExtend() {
    (function ($) {

        // wc_single_product_params is required to continue.
        if (typeof wc_single_product_params === 'undefined') {
            return false;
        }

        if ($('.woocommerce-product-gallery-type-3').length > 0) {

            let ProductGalleryExtended = function ($target, args) {
                this.$target = $target;
                this.$images = $('.woocommerce-product-gallery-type-3 figure', $target);

                // No images? Abort.
                if (0 === this.$images.length) {
                    this.$target.css('opacity', 1);
                    return;
                }

                // Bind functions to this.
                this.initPhotoswipe = this.initPhotoswipe.bind(this);
                this.getGalleryItems = this.getGalleryItems.bind(this);
                this.openPhotoswipe = this.openPhotoswipe.bind(this);

                this.initPhotoswipe();
            };

            /**
             * Init PhotoSwipe.
             */
            ProductGalleryExtended.prototype.initPhotoswipe = function () {
                this.$target.on('click', '.woocommerce-product-gallery-type-3 .e-img-wrapper a', this.openPhotoswipe);
                this.$target.on('click', '.woocommerce-product-gallery-type-3 .btn-gallery', this.openPhotoswipe);
            };

            /**
             * Get product gallery image items.
             */
            ProductGalleryExtended.prototype.getGalleryItems = function () {
                var $slides = this.$images,
                    items = [];

                if ($slides.length > 0) {
                    $slides.each(function (i, el) {
                        var img = $(el).find('.wp-post-image');

                        if (img.length) {
                            var large_image_src = img.attr('data-large_image'),
                                large_image_w = img.attr('data-large_image_width'),
                                large_image_h = img.attr('data-large_image_height'),
                                alt = img.attr('alt'),
                                item = {
                                    alt: alt,
                                    src: large_image_src,
                                    w: large_image_w,
                                    h: large_image_h,
                                    title: img.attr('data-caption') ? img.attr('data-caption') : img.attr('title')
                                };
                            items.push(item);
                        }
                    });
                }

                return items;
            };

            /**
             * Open photoswipe modal.
             */
            ProductGalleryExtended.prototype.openPhotoswipe = function (e) {
                e.preventDefault();

                var pswpElement = $('.pswp')[0],
                    items = this.getGalleryItems(),
                    eventTarget = $(e.target),
                    indexVal = parseInt(eventTarget.attr('data-index'));

                var options = $.extend({
                    index: indexVal,
                    addCaptionHTMLFn: function (item, captionEl) {
                        if (!item.title) {
                            captionEl.children[0].textContent = '';
                            return false;
                        }
                        captionEl.children[0].textContent = item.title;
                        return true;
                    }
                }, wc_single_product_params.photoswipe_options);

                var photoswipe = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
                photoswipe.init();
            };

            new ProductGalleryExtended($(document), wc_single_product_params);
        }
    })(jQuery);
}

export {productGalleryExtend};


