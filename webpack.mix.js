const mix = require('laravel-mix')

// app scripts
mix.js('./resources/assets/scripts/app.js', 'public/assets')

// app styles
mix.sass('./resources/assets/styles/old.scss', 'public/assets')
mix.postCss('./resources/assets/styles/app.css', 'public/assets', [ require("tailwindcss") ])

// settings
mix.sourceMaps()
mix.version()
