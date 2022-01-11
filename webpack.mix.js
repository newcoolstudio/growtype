let mix = require('laravel-mix');

require('@tinypixelco/laravel-mix-wp-blocks');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Sage application. By default, we are compiling the Sass file
 | for your application, as well as bundling up your JS files.
 |
 */
let sassOptions = {};

if (process.env.STATIC_URL !== undefined) {
    sassOptions['data'] = '$STATIC_ASSETS_URL: "' + process.env.STATIC_URL + '";'
} else {
    sassOptions['data'] = '$STATIC_ASSETS_URL: "";'
}

mix.setPublicPath('./public');
mix.setResourceRoot('./../')

// mix
//     .setPublicPath('./public')
// .browserSync('sage.test');

mix
    .sass('resources/styles/app.scss', 'styles', sassOptions)

    .sass('resources/styles/frontend-block-editor.scss', 'styles', sassOptions)
    .sass('resources/styles/backend-block-editor.scss', 'styles', sassOptions)
    .sass('resources/styles/admin.scss', 'styles', sassOptions)
    .sass('resources/styles/backend-standard-editor.scss', 'styles', sassOptions)

// mix.options({
//     processCssUrls: false,
//     postCss: [require('tailwindcss')],
// });

mix.autoload({
    jquery: ['$', 'window.jQuery']
})

mix
    .js('resources/scripts/app.js', 'scripts')
    .js('resources/scripts/plugins/woocommerce/wc-cart.js', 'scripts')
    .js('resources/scripts/plugins/woocommerce/wc-main.js', 'scripts')
    .js('resources/scripts/plugins/woocommerce/wc-wishlist.js', 'scripts')
    .js('resources/scripts/plugins/woocommerce/wc-checkout.js', 'scripts')
    .js('resources/scripts/plugins/woocommerce/wc-login.js', 'scripts')
    .js('resources/scripts/plugins/woocommerce/wc-coupon.js', 'scripts')

    .js('resources/scripts/plugins/acf/acf-main.js', 'scripts')

    // .extract(['axios', 'jquery', 'vue', 'slick-carousel', '@fancyapps/fancybox'])
    .version();

mix
    .scripts(['resources/scripts/plugins/cookie/cookie.js'], 'public/scripts/cookie.js')

mix
    .copyDirectory('resources/images', 'public/images')
    .copyDirectory('resources/fonts', 'public/fonts');

mix.copy('node_modules/@fancyapps/', 'public/vendor/@fancyapps')
    .copy('node_modules/jquery/', 'public/vendor/jquery')
    .copy('node_modules/slick-carousel/', 'public/vendor/slick-carousel')
    .copy('node_modules/chosen-js/', 'public/vendor/chosen-js')
    .copy('node_modules/select2/', 'public/vendor/select2');

mix
    .sourceMaps()
    .version();
