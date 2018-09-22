const _ = require('lodash');
const params = require('./gulpfile.config.params');

const run = {
    development: {
        js: {
            uglify: false
        }
    },
    production: {
        js: {
            uglify: true
        }
    }
};

module.exports = _.merge({}, run.development, run[params.env]);