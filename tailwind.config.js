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
		fontFamily: {
			'display': [ '', 'sans-serif'],
			'body': [ '', 'sans-serif']
		},
		extend: {
			colors: {
				'primary': '',
				'secondary': '',
				'accent': '',
			},
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
		plugin(function({ addUtilities, addComponents, e, prefix, config }) {
			// Add your custom styles here
		  }),
	],
};
