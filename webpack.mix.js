const mix = require('laravel-mix');



mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .version();

    // if(!mix.inProduction()) {
    //     mix.sourceMaps();
    //     mix.webpackConfig({ devtool: 'source-map'})
    //         .options({
    //             processCssUrls: false
    //         });
    // }


