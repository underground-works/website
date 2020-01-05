const mix = require('laravel-mix')

// app scripts
mix.js('./resources/assets/scripts/app.js', 'public/assets')

// app styles
mix.sass('./resources/assets/styles/app.scss', 'public/assets')

// settings
mix.sourceMaps()
mix.version()
