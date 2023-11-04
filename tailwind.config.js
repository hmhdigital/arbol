/**
 * See https://tailwindcss.com/docs/configuration for configuration details
 */

/**
 * Convert pixels to rems
 * @param {int} px The pixel value to convert to rems
 */


const fs = require( 'fs' );
const glob = require('glob');
const plugin = require('tailwindcss/plugin');

const themeJson = fs.readFileSync( './theme.json' );
const theme = JSON.parse( themeJson );

// eslint-disable-next-line no-unused-vars
const rem = px => `${px / 16}rem`;


let colors = {};
theme.settings.color.palette.forEach(color => {
	colors[color.slug] = color.color;
});

let fonts = {};
theme.settings.typography.fontFamilies.forEach(fam => {
	fonts[fam.slug] = fam.fontFamily.split(',');
});


module.exports = {
	content: [
		'./**/*.php',
		'./views/**/*.twig'
	].concat(glob.sync('./*.php')),
	// have to use glob sync because otherwise base folder becomes tw dependency and infinite loop because of index.asset.php
	// glob returns array of actual files and this way build folder is definitively ignored
	theme: {
		fontFamily: fonts,
		extend : {
			colors: colors,
			height: {
				'screen-50': '50vh',
				'screen-60': '60vh',
				'screen-70': '70vh'
			},
			minHeight: {
				'screen-50': '50vh',
			},
			zIndex: {
				'-10': '-10',
				'-20': '-20',
				'-30': '-30',
			},
			screens: {
				'xs': '360px'
			}
		},
		container: {
			center: true,
			padding: {
				DEFAULT: '1rem',
				md: '3rem',
				xl: '6rem'
			},
		},
	},
	variants: {
		extend: {},
	},
	plugins: [
		require('@tailwindcss/forms'),
		// eslint-disable-next-line no-unused-vars
		plugin(function({ addUtilities, addComponents, e, prefix, config }) {
			// Add your custom styles here
			// eslint-disable-next-line no-mixed-spaces-and-tabs
		  }),
	],
};
