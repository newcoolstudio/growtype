function inputQuantity() {

    function changeInputQuantityWithArrows() {
        $('.quantity .btn').click(function () {
            var currentQuantityInput = $(this).closest('.quantity').find('input[type="number"]');
            var currentQuantity = currentQuantityInput.val().length > 0 ? currentQuantityInput.val() : 0;
            var currentQuantityInputMax = currentQuantityInput.attr('max');
            var currentQuantityInputMin = currentQuantityInput.attr('min');

            if ($(this).hasClass('btn-down')) {
                if (currentQuantityInputMin.length > 0 && currentQuantity <= currentQuantityInputMin) {
                    return false;
                }
                if (currentQuantity > 0) {
                    currentQuantity = parseInt(currentQuantity) - 1
                }
            } else if ($(this).hasClass('btn-up')) {
                if (currentQuantityInputMax.length > 0 && currentQuantity >= currentQuantityInputMax) {
                    return false;
                }
                currentQuantity = parseInt(currentQuantity) + 1
            }
            currentQuantityInput.val(currentQuantity);
            currentQuantityInput.change();
        });
    }

    changeInputQuantityWithArrows();

    $(document.body).on('updated_cart_totals', function () {
        changeInputQuantityWithArrows();
    });
}

export {inputQuantity};





