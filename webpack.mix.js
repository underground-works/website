const mix = require('laravel-mix')

// app scripts
mix.js('./resources/assets/scripts/app.coffee', 'public/assets')

// app styles
mix.sass('./resources/assets/styles/app.scss', 'public/assets')

// vendor scripts
mix.styles([
	'./node_modules/jquery/dist/jquery.min.js'
], 'public/assets/app-vendor.js');

// settings
mix.version()

if (! mix.inProduction()) mix.sourceMaps()

mix.webpackConfig({
	module: {
		rules: [
			{ test: /\.coffee$/, loader: 'coffee-loader' }
		]
	}
});
