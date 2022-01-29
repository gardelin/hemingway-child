let mix = require('laravel-mix');

mix.setResourceRoot('../');

mix.copy('resources/assets/fonts', 'public/assets/fonts');
mix.copy('resources/assets/img', 'public/assets/img');
mix.js('resources/assets/js/app.js', 'public/assets/js');
mix.sass('resources/assets/sass/app.scss', 'public/assets/css');

if (mix.inProduction()) {
    mix.version().sourceMaps();
}
