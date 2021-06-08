import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import tailwindcss from 'tailwindcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import del from 'del';
import webpack from 'webpack-stream';
import named from 'vinyl-named';
import browserSync from 'browser-sync';
import zip from 'gulp-zip';
import info from './package.json';
import replace from 'gulp-replace';
// import wpPot from 'gulp-wp-pot';

const PRODUCTION = yargs.argv.prod;
const server = browserSync.create();
const local = require( './local.json' );

export const serve = done => {
	server.init({
		proxy: local.proxy, // url from local.json file
		browser: 'google chrome'
	});
	done();
};

export const reload = done => {
	server.reload();
	done();
};

export const clean = () => del([ 'assets/build' ]);

export const styles = () => {
	return src([ 'assets/src/scss/main.scss', 'assets/src/scss/editor.scss' ])
		.pipe( gulpif( ! PRODUCTION, sourcemaps.init() ) )
		.pipe( sass().on( 'error', sass.logError ) )
		.pipe( postcss([ tailwindcss( './tailwind.config.js' ) ]) )
		.pipe( gulpif( PRODUCTION, postcss([ autoprefixer ]) ) )
		.pipe( gulpif( PRODUCTION, cleanCss({compatibility: 'ie8'}) ) )
		.pipe( gulpif( ! PRODUCTION, sourcemaps.write() ) )
		.pipe( dest( 'assets/build/css' ) )
		.pipe( server.stream() );
};

export const images = () => {
	return src( 'assets/src/img/**/*.{jpg,jpeg,png,svg,gif}' )
		.pipe( gulpif( PRODUCTION, imagemin() ) )
		.pipe( dest( 'assets/build/img' ) );
};

export const copy = () => {
	return src([ 'assets/src/**/*', '!assets/src/{img,js,scss}', '!assets/src/{img,js,scss}/**/*' ])
		.pipe( dest( 'assets/build' ) );
};

export const scripts = () => {
	return src([ 'assets/src/js/app.js', 'assets/src/js/custom/custom.js'])
		.pipe( named() )
		.pipe( webpack({
			module: {
				rules: [
					{
						test: /\.js$/,
						use: {
							loader: 'babel-loader',
							options: {
								presets: ['@babel/preset-env']
							}
						}
					}
				]
			},
			mode: PRODUCTION ? 'production' : 'development',
			devtool: ! PRODUCTION ? 'inline-source-map' : false,
			output: {
				filename: '[name].js'
			},
			externals: {
				jquery: 'jQuery'
			}
		}) )
		.pipe( dest( 'assets/build/js' ) );
};

export const compress = () => {
	return src([
		'**/*',
		'!node_modules{,/**}',
		'!bundled{,/**}',
		'!assets/src{,/**}',
		'!.editorconfig',
		'!.babelrc',
		'!.eslintignore',
		'!.eslint.js',
		'!.eslintrc.js',
		'!.gitignore',
		'!gulpfile.babel.js',
		'!tailwind.config.js',
		'!phpcs.xml.dist',
		'!package.json',
		'!package-lock.json',
		'!composer.json',
		'!comoser.lock',
		'!local.json',
		'!local.example.json',

	])
		.pipe(
			gulpif(
				file => 'zip' !== file.relative.split( '.' ).pop(),
				replace( 'besu', info.name )
			)
		)
		.pipe( zip( `${info.name}.zip` ) )
		.pipe( dest( 'bundled' ) );
};

// export const pot = () => {
// 	return src( '**/*.php' )
// 		.pipe(
// 			wpPot({
// 				domain: 'besu',
// 				package: info.name
// 			})
// 		)
// 		.pipe( dest( `languages/${info.name}.pot` ) );
// };

export const watchForChanges = () => {
	watch( 'assets/src/scss/**/*.scss', styles );
	watch( 'assets/src/img/**/*.{jpg,jpeg,png,svg,gif}', series( images, reload ) );
	watch([ 'assets/src/**/*', '!assets/src/{img,js,scss}', '!assets/src/{img,js,scss}/**/*' ], series( copy, reload ) );
	watch( 'assets/src/js/**/*.js', series( scripts, reload ) );
	watch( '**/*.php', reload );
	watch( 'views/**/*.twig', reload );
};

export const dev = series( clean, parallel( styles, scripts, images, copy  ), serve, watchForChanges );
export const build = series( clean, parallel( styles, scripts, images, copy ), compress );
export default dev;
