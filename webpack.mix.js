const mix = require('laravel-mix');
mix.js('resources/js/app-frontend.js', 'public/js')
   .sass('resources/sass/frontend/app-frontend.scss', 'public/css');
mix.sass('resources/sass/backend/app-backend.scss', 'public/css');
mix.sass('resources/sass/web-access/web-access.scss', 'public/css');
