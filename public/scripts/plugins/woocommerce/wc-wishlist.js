!function(t){document.addEventListener("filterProductsByOrder",c),document.addEventListener("filterProductsByPrice",c);var i="<span class='addToCart-loader'><div></div><div></div></span>";function e(t,i){return i.indexOf(t)>-1}Array.prototype.unique=function(){return this.filter((function(t,i,e){return e.indexOf(t)===i}))};var s=woocommerce_params_wishlist.shop_name+"-wishlist",a=woocommerce_params_wishlist.in_wishlist_text,n=woocommerce_params_wishlist.rest_url,r=new Array,o=sessionStorage.getItem(s),l=!!t("body").hasClass("logged-in"),h="";function d(){t(".wishlist-preview").is(":empty")&&t(".wishlist-preview").append(i),t.ajax({type:"POST",url:woocommerce_params.ajax_url,data:{action:"fetch_user_data",dataType:"json",wishlist_ids:r},success:function(i){h=JSON.parse(i),r=h.wishlist_ids,t(".wishlist-preview").length>0&&(0===t(".wishlist-preview .products").length?t(".wishlist-preview").hide().html(h.wishlist).fadeIn():t(".wishlist-preview").html(h.wishlist)),l&&sessionStorage.removeItem(s),c()},error:function(){}})}function u(e){e.on("click",(function(n){if(n.preventDefault(),!t(this).hasClass("is-loading")){if(t(this).addClass("is-loading"),t(this).hasClass("is-active")){t(this).removeClass("is-active"),t("body").hasClass("template-wishlist")&&t(this).closest(".product").fadeOut().promise().done((function(){t(this).remove()}));for(var o=r.length-1;o>=0;o--)r[o]==t(this).data("product")&&r.splice(o,1)}else t(this).addClass("is-active"),r.push(t(this).data("product").toString());0===(r=r.unique().filter((function(t){return""!==t}))).length&&t(".wishlist-preview").length>0&&t(".wishlist-preview").append(i),t(".e-wishlist").attr("data-amount",r.length),l?t.ajax({type:"POST",url:woocommerce_params_wishlist.ajax_post,data:{action:"user_wishlist_update",user_id:h.user_id,wishlist_ids:r.join(",")}}).done((function(t){0===r.length&&d()})).fail((function(t){alert(woocommerce_params_wishlist.error_text)})):(sessionStorage.setItem(s,r.toString()),0===r.length&&d()),u=e,c=a,setTimeout((function(){u.removeClass("is-loading").attr("title",c)}),500)}var u,c}))}function c(){r=r.filter((function(t){return""!=t})),t(".e-wishlist").attr("data-amount",r.length),t(".wishlist-toggle").each((function(){var i=t(this);if(!l){var s=i.data("product");s=s.toString(),!l&&e(s,r)&&i.addClass("is-active").attr("title",a)}u(i)}))}l?d():(void 0!==o&&null!=o&&(o=(o=o.split(",")).unique(),r=o),t(".wishlist-preview").length>0?d():c()),u(t(".wishlist-toggle")),setTimeout((function(){r.length&&(n+="?include="+r.join(","),n+="&per_page="+r.length,t.ajax({dataType:"json",url:n}).done((function(t){})).fail((function(t){alert(woocommerce_params_wishlist.no_wishlist_text)})))}),1e3)}(jQuery);
//# sourceMappingURL=wc-wishlist.js.map