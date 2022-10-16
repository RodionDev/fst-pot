const mix = require('laravel-mix');
const SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin');
mix.js('resources/js/app-frontend.js', 'public/js')
   .sass('resources/sass/frontend/app-frontend.scss', 'public/css');
mix.sass('resources/sass/backend/app-backend.scss', 'public/css');
mix.sass('resources/sass/web-access/web-access.scss', 'public/css');
mix.webpackConfig({
    plugins: [
        new SWPrecacheWebpackPlugin({
            cacheId: 'vspot-pwa',
            filename: 'service-worker.js',
            staticFileGlobs: ['public*.{css,eot,svg,png,jpg,ico,ttf,woff,woff2,js,html}'],
            minify: true,
            stripPrefix: 'public/',
            handleFetch: true,
            dynamicUrlToDependencies: {
            },
            staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /site\.webmanifest$/, /manifest\.json$/, /service-worker\.js$/],
            navigateFallback: '/',
            runtimeCaching: [
                {
                    urlPattern: /^https:\/\/fonts\.googleapis\.com\
                    handler: 'cacheFirst'
                }
            ],
        })
    ]
});
