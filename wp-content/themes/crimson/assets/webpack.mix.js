let mix = require('laravel-mix');

mix.webpackConfig({
    watchOptions: { ignored: /node_modules/ },
    externals: {jquery: 'jQuery'}
});

mix.setPublicPath('./');
 
mix
.sass('css/scss/app.scss', 'css/app.css')
.sass('css/scss/editor.scss', 'css/editor.css')
.js('js/src/app.js', 'js/app.js')
.version()
.sourceMaps()
.options({ processCssUrls: false });
