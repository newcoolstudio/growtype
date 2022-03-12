function selectVariation() {
    jQuery(document).ready(function ($) {
        if ($('body').hasClass('single-product')) {

            /**
             * Disable script if only radio select is enabled
             */
            if ($('.single-product').find('.options[data-type="radio"]').length === 1 && $('.single-product').find('.options[data-type="select"]').length === 0) {
                return false;
            }

            let variation_form = $('.variations_form.cart')
            let product_id = variation_form.data('product_id');

            window.product_variations = window['product_variations_' + product_id + ''];

            if (typeof window.product_variations === 'undefined' || window.product_variations === false) {
                return false;
            }

            let first_select = $('.variations .options select').first();

            $('.variations .variations-single:first .options select option').map(function (index, element) {
                if ($(element).val().length === 0) {
                    $(element).prop("disabled", true);
                }
            });

            if (window.cartSelect !== undefined) {
                window.cartSelect.change(function (e) {

                    $('.variations_form button[type="submit"]').attr('disabled', true);

                    if ($('.variation-parent input[type="radio"]:checked').length > 0) {
                        window.selected_variation_final = find_matching_variation(window.selected_variations, $(e.target).attr('id'), $(e.target).find(':selected').val());
                    } else {
                        window.selected_variations = find_matching_variation(window.product_variations, $(e.target).attr('id'), $(e.target).find(':selected').val());
                    }

                    if (window.selected_variations.length <= 0) {
                        return false;
                    }

                    var all_previous_selected = true;

                    if (typeof window.selected_variations !== 'undefined') {
                        window.cartSelect.each(function (index, element) {
                            if ($(e.target).attr('id') === first_select.attr('id')) {
                                window.variation = [];
                                Object.keys(window.selected_variations[0].attributes).map(function (item) {
                                    if (item !== 'attribute_' + first_select.attr('id')) {
                                        window.cartSelect.each(function (index, parent) {
                                            if (item === 'attribute_' + $(parent).attr('id')) {
                                                $('#' + $(parent).attr('id') + ' option').prop("disabled", true);
                                                $(parent).val('').chosen(window.selectArgs)
                                                window.selected_variations.map(function (child) {
                                                    window.variation.push(child)
                                                    $('#' + $(parent).attr('id') + ' option[value=' + child.attributes[item] + ']').prop("disabled", false);
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                            if ($(element).val() === null) {
                                $('.variations-single[data-type="' + $(element).attr('id') + '"]')
                                    .find('.chosen-container')
                                    .addClass('is-shaking');
                                setTimeout(function () {
                                    $('.variations-single').find('.chosen-container').removeClass('is-shaking');
                                }, 800);
                                $(element)
                                    .val('')
                                    .trigger("chosen:updated");
                                all_previous_selected = false;
                                return false;
                            }
                        });
                    }

                    if (all_previous_selected) {
                        if ($(e.target).find(':selected').val().length === 0) {
                            $('.variations-single label[for="' + $(e.target).attr('id') + '"] .e-name').text('');
                        } else {
                            $('.variations-single label[for="' + $(e.target).attr('id') + '"] .e-name').text($(e.target).find(':selected').val());
                        }

                        var all_selected = true;
                        window.cartSelect.each(function (index, element) {
                            if ($(element).find(':selected').val().length === 0) {
                                all_selected = false;
                                return false;
                            }
                        });

                        if (all_selected) {
                            if ($('.variation-parent input[type="radio"]:checked').length === 0) {
                                window.selected_variation_final = window.selected_variations;
                            }

                            if (typeof window.variation !== 'undefined' && window.variation.length > 0) {
                                window.selected_variation_final = window.variation
                            }

                            /**
                             * Update final product details
                             */
                            if (typeof window.selected_variation_final !== 'undefined' && window.selected_variation_final.length !== 0) {
                                window.selected_variation_final.map(function (parent) {
                                    if (parent.attributes['attribute_' + $(e.target).attr('id')] === $(e.target).val()) {
                                        variation_form.find('.variation_id').val(parent['variation_id']);
                                        update_price(parent);
                                        set_featured_image(parent);
                                        // update_description(parent);
                                    }
                                });
                                $('.variations_form button[type="submit"]')
                                    .removeClass('disabled')
                                    .removeClass('wc-variation-selection-needed')
                                    .attr('disabled', false)
                            }
                        }
                    }
                });
            }

            /**
             * Update frontend product price
             */
            function update_price(variation) {
                if (variation['price_html'].length > 0) {
                    $('.product .summary .price').replaceWith(variation['price_html']);
                }
                $('.product .summary .price').show();
            }

            /**
             * Update frontend product description
             */
            function update_description(variation) {
                if (variation['variation_description'].length > 0) {
                    $('.variations-single-description .variations-single-description-content').html(variation['variation_description']).closest('.variations-single-description').fadeIn();
                } else {
                    $('.variations-single-description .variations-single-description-content').html('').closest('.variations-single-description').fadeOut();
                }
            }

            function set_featured_image(variation) {
                var thumbnailExists = false;
                if ($('.flex-control-nav img').length > 0) {
                    $('.flex-control-nav img').each(function (index, element) {
                        if ($(element).attr('src') === variation['image']['gallery_thumbnail_src']) {
                            thumbnailExists = true;
                            $(element).trigger('click');
                        }
                    });
                }
            }

            function find_matching_variation(product_variations, element_id, value) {
                var matching = [];
                for (var i = 0; i < product_variations.length; i++) {
                    var variation = product_variations[i];
                    if (variation['attributes']['attribute_' + element_id] == value) {
                        matching.push(variation);
                    }
                }
                return matching;
            }
        }
    });
}

export {selectVariation};


