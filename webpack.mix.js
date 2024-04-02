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

// if (process.env.STATIC_URL !== undefined) {
//     sassOptions['data'] = '$STATIC_ASSETS_URL: "' + process.env.STATIC_URL + '";'
// } else {
//     sassOptions['data'] = '$STATIC_ASSETS_URL: "";'
// }

mix.setPublicPath('./public');
mix.setResourceRoot('./../')

mix
    .sass('resources/styles/app.scss', 'styles', sassOptions)

    .sass('resources/styles/frontend-block-editor.scss', 'styles', sassOptions)
    .sass('resources/styles/backend-block-editor.scss', 'styles', sassOptions)
    .sass('resources/styles/admin.scss', 'styles', sassOptions)
    .sass('resources/styles/backend-standard-editor.scss', 'styles', sassOptions)

    .version();

mix
    .js('resources/scripts/app.js', 'scripts')
    .js('resources/scripts/frontend-block-editor.js', 'scripts')

    .version();

mix
    .js('resources/scripts/backend-block-editor.js', 'scripts')
    .react()

mix
    .js(['resources/scripts/plugins/fancybox/index.js'], 'public/scripts/plugins/fancybox/index.js')
    .js(['resources/scripts/plugins/slick-carousel/index.js'], 'public/scripts/plugins/slick-carousel/index.js')

mix
    .scripts(['resources/scripts/plugins/flexmenu/flexmenu.js'], 'public/scripts/plugins/flexmenu/flexmenu.js')
    .scripts(['resources/scripts/plugins/cookie/cookie.js'], 'public/scripts/cookie.js')
    .scripts(['resources/scripts/plugins/resize/resize-sensor.js'], 'public/scripts/plugins/resize/resize-sensor.js')

mix
    .copyDirectory('resources/images', 'public/images')
    .copyDirectory('resources/icons', 'public/icons')

    /**
     * Woocommerce fonts
     */
    .copyDirectory('resources/fonts/plugins/woocommerce', 'public/styles/plugins/fonts')

    /**
     * Plugins
     */
    .copyDirectory('resources/plugins', 'public/plugins')

mix.copy('node_modules/@fancyapps/', 'public/vendor/@fancyapps')
    .copy('node_modules/jquery/', 'public/vendor/jquery')
    .copy('node_modules/slick-carousel/', 'public/vendor/slick-carousel')
    .copy('node_modules/chosen-js/', 'public/vendor/chosen-js')
    .copy('node_modules/select2/', 'public/vendor/select2');
