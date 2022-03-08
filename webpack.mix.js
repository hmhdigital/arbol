const mix = require('laravel-mix');
const local = require( './local.json' );

require('mix-tailwindcss');

mix.setPublicPath('./assets');

mix.sass('src/scss/main.scss', '/css').tailwind().sourceMaps();
mix.js('src/js/app.js', '/js');

mix.browserSync({
    proxy: local.proxy, // url from local.json file
	browser: 'google chrome',
    files: [
        '**/*.php',
        '**/*.js',
        '**/*.css',
		'**/*.twig',
    ]
});
