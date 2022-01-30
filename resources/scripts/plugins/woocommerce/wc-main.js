import {productSlider} from "./components/sliders/product";
import {productsSlider} from "./components/sliders/products"
import {productGalleryExtend} from "./components/product-gallery"
import {inputQuantity} from "./components/input-quantity"
import {radioVariation} from "./components/radio-variation"
import {selectVariation} from "./components/select-variation"
import {selectCart} from "./../../plugins/chosen/select-cart.js";
import {sidebarProducts} from "./sidebar/sidebar-products";

jQuery(document).ready(() => {
  productSlider();
  productsSlider();
  productGalleryExtend();
  inputQuantity();
  radioVariation();
  selectVariation();
  selectCart();
  // sidebarProducts();
});
