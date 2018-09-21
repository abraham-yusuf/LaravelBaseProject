const _ = require('lodash');
const params = require('./gulpfile.config.params');

const run = {
    development: {
        js: {
            uglify: false
        },
        css: {
            cssnano: false
        }
    },
    production: {
        js: {
            uglify: true
        },
        css: {
            cssnano: true
        }
    }
};

module.exports = _.merge({}, run.development, run[params.env]);