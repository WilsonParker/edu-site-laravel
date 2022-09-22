const mix = require('laravel-mix');

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
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix
    .scripts([
        'resources/js/videoHelper.js',
        'resources/js/lecture.js',
    ], 'public/js/_lectureCombine.js')
    .js('public/js/_lectureCombine.js', 'public/js/_lectureConvert.js')
    .babel('public/js/_lectureConvert.js', 'public/js/videoHelper.js');
