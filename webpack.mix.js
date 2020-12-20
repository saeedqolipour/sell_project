const mix = require('laravel-mix');

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

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')

exports.plugins.push(
    new VuetifyLoaderPlugin({
        match (originalTag, { kebabTag, camelTag, path, component }) {
            if (kebabTag.startsWith('core-')) {
                return [
                    camelTag,
                    `import ${camelTag} from '@/components/core/${camelTag.substring(4)}.vue'`
                ]
            }
        }
    })
)

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
