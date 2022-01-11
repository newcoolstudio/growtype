import {productSlider} from "./sections/sliders/product.js";
import {productsSlider} from "./sections/sliders/products"
import {inputQuantity} from "./components/input-quantity"
import {radioVariation} from "./components/radio-variation"
import {selectVariation} from "./components/select-variation"
import {selectCart} from "./../../plugins/chosen/select-cart.js";
import {sidebarProducts} from "./sidebar/sidebar-products";

jQuery(document).ready(() => {
  productSlider();
  productsSlider();
  inputQuantity();
  radioVariation();
  selectVariation();
  selectCart();
  // sidebarProducts();
});
