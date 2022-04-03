const mix = require('laravel-mix');

mix.js('resources/js/admin/app.js', 'public/js/admin')
    .vue()
    .postCss('resources/css/admin/app.css', 'public/css/admin', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
}
