function radioVariation() {
    jQuery(document).ready(function ($) {
        if ($('body').hasClass('single-product')) {

            /**
             * Check if enabled
             */
            if ($('.single-product').find('.options[data-type="radio"]').length === 0) {
                return false;
            }

            let variation_form = $('.variations_form.cart')
            let product_id = variation_form.data('product_id');
            window.product_variations = window['product_variations_' + product_id + ''];

            if (typeof window.product_variations === 'undefined' || window.product_variations === false) {
                return false;
            }

            /**
             * If more then one selection group
             */
            if ($('.cart .variations .variations-single').length > 1) {
                $('.variations_form button[type="submit"]').attr('disabled', true);
            } else {
                setTimeout(function () {
                    $('.variations_form button[type="submit"]')
                        .removeClass('disabled')
                        .removeClass('wc-variation-selection-needed')
                        .attr('disabled', false)
                }, 100)
            }

            window.selected_variations = find_matching_variations(
                window.product_variations,
                $('.variations .variations-single:first input[type="radio"]:checked').attr('name'),
                $('.variations .variations-single:first input[type="radio"]:checked').data('category'));

            let price_html = window.selected_variations.length > 0 ? window.selected_variations[0]['price_html'] : '';

            /**
             * Set firs variation as active
             */
            $('.variations .options .option:first').addClass('is-active');

            find_matching_attributes(window.selected_variations, $('.variations .variations-single:first input[type="radio"]:checked'))

            if (window.selected_variations.length > 0 && screen.width > 1024) {
                setTimeout(function () {
                    set_featured_image(window.selected_variations[0])
                }, 100)
            }

            if (price_html.length > 0) {
                update_price(window.selected_variations[0]);
            }

            variation_form.find('.variation_id').val($('.variations input[type="radio"]:checked').val())

            $('.product .summary .price').show()

            $('.variations input[type="radio"]').change(function () {
                console.log('change')
                window.selected_variations = find_matching_variations(window.product_variations, $(this).attr('name'), $(this).data('category'));

                $(this).closest('.options').find('.option').removeClass('is-active');
                $(this).closest('.option').addClass('is-active');
                $(this).closest('.variations-single').find('.label .e-name').html($(this).data('term-name'));

                if (window.selected_variations.length === 0) {
                    return false;
                }

                set_featured_image(window.selected_variations[0])

                if (window.selected_variations[0]['price_html'].length > 0) {
                    update_price(window.selected_variations[0]);
                }

                $('.product .summary .price').show();

                if ($('.variations').attr('data-variations-amount') > '1' && $(this).closest('.variations-single').hasClass('variation-parent')) {
                    find_matching_attributes(window.selected_variations, $('.variations .variations-single:first input[type="radio"]:checked'))
                }

                variation_form.find('.variation_id').val($(this).val())
            });

            function update_price(variation) {
                if (variation['price_html'].length > 0) {
                    $('.product .summary .price').replaceWith(variation['price_html']);
                }
                $('.product .summary .price').show();
            }

            function find_matching_variations(product_variations, attribute_name, value) {
                var matching = [];

                product_variations.map(function (variation) {
                    if (variation.attributes[attribute_name] === value) {
                        matching.push(variation)
                    }
                });

                return matching;
            }

            function set_featured_image(variation) {
                var thumbnailExists = false;
                if ($('.flex-control-nav li img').length > 0) {
                    $('.flex-control-nav li img').each(function (index, element) {
                        if ($(element).attr('src') === variation['image']['gallery_thumbnail_src']) {
                            thumbnailExists = true;
                            $(element).trigger('click');
                            return false;
                        }
                    });
                }
            }

            function find_matching_attributes(product_variations, main_attribute) {
                $('.variation-child input[type="radio"]').prop('checked', false).closest('.option').removeClass('is-active');

                if (window.cartSelect !== undefined && window.cartSelect.length > 0) {
                    $('.variations_form button[type="submit"]').attr('disabled', true);
                    $('.variations-single select option').prop("disabled", true);
                    product_variations.map(function (variation) {
                        window.cartSelect.map(function (index, select) {
                            $('#' + $(select).attr('id') + ' option[value="' + variation.attributes['attribute_' + $(select).attr('id')] + '"]').prop("disabled", false);
                        });
                    });
                    $('.variations-single select')
                        .val('')
                        .trigger("chosen:updated");
                }
            }
        }
    });
}

export {radioVariation};


