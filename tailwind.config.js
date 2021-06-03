const plugin = require('tailwindcss/plugin');

module.exports = {
	purge: {
		content: [
			'./**/*.php',
			'./views/**/*.twig',
			'./assets/src/**/*.js'
		]
	},
	darkMode: false, // or 'media' or 'class'
	theme: {
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [],
};
