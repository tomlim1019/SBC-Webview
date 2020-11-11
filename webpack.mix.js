const mix = require('laravel-mix');
require('vuetifyjs-mix-extension')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
mix.vuetify() // Update, don't use `vuetify-loader`, use default instead `vuetify`, since vue-loader 15 don't allow useOf()
mix.sass('resources/sass/app.scss', 'public/css')

/// Here's the Webpack (as a normal webpack project) entry point to configure every setting we need.
mix.webpackConfig({
    resolve: {
        alias: {
           /// Internal Plugins
           '#': __dirname + '/resources/js',
           '#Components' : __dirname + "/resources/js/components",
           
           /// External Plugins
           '@': __dirname + '/src',
        }
     }
})

mix.version()