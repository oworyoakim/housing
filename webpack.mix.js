const mix = require('laravel-mix');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// App
mix
    .js('resources/admin/js/app.js', 'public/admin/js')
    .sass('resources/admin/sass/app.scss', 'public/admin/css')
    // Merge and compile multiple scripts to manager/vendor.js
    .js([
        'node_modules/admin-lte/plugins/jquery/jquery.slim.min.js',
        'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'node_modules/admin-lte/plugins/select2/js/select2.full.min.js',
        'node_modules/admin-lte/plugins/toastr/toastr.min.js',
        'node_modules/admin-lte/plugins/daterangepicker/daterangepicker.js',
        'node_modules/admin-lte/dist/js/adminlte.min.js',
        'node_modules/admin-lte/plugins/summernote/summernote-bs4.min.js',
    ], 'public/manager/js/theme.js')
    .js('resources/js/manager/app.ts', 'public/manager/js')
    .extract(['vue','moment','numeral'], 'public/js/vendor.js')
    .sass('resources/js/manager/sass/app.scss', 'public/manager/css')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .vue( {version: 3});

if (mix.inProduction()) {
    mix.version();
}
mix.webpackConfig(webpack => {
    return {
        module: {
            rules: [
                {
                    test: /\.tsx?$/,
                    loader: "ts-loader",
                    options: { appendTsSuffixTo: [/\.vue$/] },
                    exclude: /node_modules/
                }
            ]
        },
        resolve: {
            extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"],
            alias: {
                '@': path.resolve(__dirname, 'resources/js/')
            }
        },
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
            }),
        ],
        // stats: {
        //     children: true,
        // },
    }
})
