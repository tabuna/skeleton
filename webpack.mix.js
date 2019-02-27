let mix = require('laravel-mix');

mix
    .sass('resources/sass/app.scss', 'css/app.css', {
        implementation: require('node-sass')
    })
    .options({
        processCssUrls: false
    })
    .js('resources/js/app.js', 'js/app.js')
    .setPublicPath('public')
    .version();