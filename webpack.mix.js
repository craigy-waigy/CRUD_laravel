const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('node_modules/chart.js/dist/Chart.js', 'public/js/chart.js')
    .copy('node_modules/font-awesome/fonts/', 'public/fonts')
    .sass('resources/sass/app.scss', 'public/css')
    .version();

