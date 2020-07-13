const mix  = require('laravel-mix');

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

mix.webpackConfig({
   output: {
       chunkFilename: 'js/[name].[chunkhash].js',
   },
});

mix.setPublicPath('public_html/');

//mix.js('resources/js/login.js', 'js')
//   .sass('resources/sass/login.scss', 'css');

mix.js('resources/js/app.js', 'js/app.js')
   .sass('resources/sass/app.scss', 'css')


mix.browserSync('http://localhost:8000/entes_control/crear_informe');

//mix.browserSync({
//   proxy: 'http://huem.local:88',
//   open : false,
//});


if( mix.inProduction() ){
   mix.version();
}
