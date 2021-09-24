const mix = require('laravel-mix');
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/frontend/app.scss', 'public/css');
mix.sass('resources/sass/backend/app-backend.scss', 'public/css');
