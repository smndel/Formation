let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .scripts(
      ['resources/assets/js/confirm.js', 
      'resources/assets/js/deleteAll.js', 
      'resources/assets/js/changeStatus.js' 
      ], 'public/js/all.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .browserSync({
   		proxy: {
   			target: 'localhost:8000',
   			reqHeaders: function(){
   				return{
   					host: 'localhost:3000'
   				}
   			}
   		},
         files: [
               'app/**/*.php',
               'resources/views/**/*.php',
               'public/assets/js/**/*.js',
               'public/assets/css/**/*.css'
         ]
   });

