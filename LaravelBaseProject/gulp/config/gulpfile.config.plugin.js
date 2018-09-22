const _ = require('lodash');
const params = require('./gulpfile.config.params');
const paths = require('./gulpfile.config.path');

const postCssAppProcessors = [
    require('postcss-import'),
    require('postcss-nested'),
    require("postcss-media-variables"),
    require("postcss-custom-media"),
    require('postcss-css-variables'),
    require('postcss-calc'),
    require("postcss-media-variables"),
    require("postcss-media-minmax")
];

const postCssVendorsProcessors = [
    require('postcss-import')
];

const plugin = {
    development: {
        js: {
            uglify: {
                mangle: false
            },
            hashFiles: {
                template: '<%= name %><%= ext %>?<%= hash %>'
            },
            hashManifest: {
                deleteOld: true,
                sourceDir: paths.dest.js.app
            }
        },
        css: {
            postcss: {
                app: postCssAppProcessors,
                vendors: postCssVendorsProcessors
            },
            cssnano: {discardComments: {removeAll: true}}
        }
    },
    production: {
        js: {
            uglify: {
                mangle: true
            },
            hashFiles: {
                template: '<%= name %>?<%= hash %><%= ext %>'
            },
            hashManifest: {
                deleteOld: true,
                sourceDir: paths.dest.js.app
            }
        },
        css: {
            postcss: {
                app: postCssAppProcessors,
                vendors: postCssVendorsProcessors
            },
        }
    }
};

module.exports = _.merge({}, plugin.development, plugin[params.env]);