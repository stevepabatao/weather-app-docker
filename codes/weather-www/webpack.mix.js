const mix = require('laravel-mix');

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader'
                ]
            }
        ]
    },
    resolve: {
        symlinks: false,
        extensions: ['.js', '.vue', '.json'],
    }
})

   .js('resources/js/app.js', 'public/js').vue({ version: 3 })
   .sass('resources/sass/app.scss', 'public/css')




