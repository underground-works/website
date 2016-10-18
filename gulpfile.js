var elixir = require('laravel-elixir');

require('laravel-elixir-coffeeify');

elixir.config.js.browserify.options = { debug: true };

elixir(function(mix) {

    // App Styles
    mix.sass('./resources/assets/styles/app.scss', 'public/assets/app.css');

    // App Scripts
    mix.browserify('./resources/assets/scripts/app.coffee', 'public/assets/app.js');

    // App Vendor Scripts
    mix.scripts([
        './node_modules/jquery/dist/jquery.min.js',
    ], 'public/assets/app-vendor.js');

    // Version all files
    mix.version([
        'assets/app.css', 'assets/app.js', 'assets/app-vendor.js'
    ]);

});
