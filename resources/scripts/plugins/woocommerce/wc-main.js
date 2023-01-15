import {productSlider} from "./components/sliders/product";
import {productsSlider} from "./components/sliders/products"
import {productGalleryExtend} from "./components/product-gallery"
import {inputQuantity} from "./components/input-quantity"
import {countdown} from "./components/countdown"
import {radioVariation} from "./components/radio-variation"
import {selectVariation} from "./components/select-variation"
import {selectCart} from "./../../plugins/chosen/select-cart";
import {sidebar} from "./sidebar";

jQuery(document).ready(() => {
  productSlider();
  productsSlider();
  productGalleryExtend();
  inputQuantity();
  radioVariation();
  selectVariation();
  selectCart();
  countdown();
  sidebar();
});
