// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files and `theme.json` trigger a rebuild.
		'./theme/**/*.{php,js}',
		'./theme/theme.json',
	],
	theme: {
		// Extend the default Tailwind theme.
		extend: {
			colors: {
				primary: '#3B2F4A',
				secondary: '#EF3343',
				themeblue: '#142346',
				gray: '#AAAAAA',
			},
			screens: {
				'2xl': '1660px',
			},
		},
		fontFamily: {
			sans: ['"Open Sans"', 'system-ui'],
			title: ['"Alice"'],
			poppins: ['Poppins', 'sans-serif'],
		},
		container: {
			center: true,
			padding: {
				DEFAULT: '10px',
				// sm: '2rem',
				// lg: '4rem',
				// xl: '5rem',
				'2xl': '1.5rem',
			},
		},
	},
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson')(require('../theme/theme.json')),

		// Add Tailwind Typography.
		require('@tailwindcss/typography'),

		// Uncomment below to add additional first-party Tailwind plugins.
		// require('@tailwindcss/forms'),
		// require('@tailwindcss/aspect-ratio'),
		// require('@tailwindcss/container-queries'),
	],
};
