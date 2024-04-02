import {initFancybox} from "./initFancybox";

jQuery(document).ready(() => {
    jQuery('.growtype-theme-fancybox').each(function (index, element) {
        initFancybox(jQuery(element))
    });
});
