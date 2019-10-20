const _ = require('lodash');
const params = require('./gulpfile.config.params');

const run = {
    noMin: {
        js: {
            uglify: false
        }
    },
    min: {
        js: {
            uglify: true
        }
    }
};

module.exports = _.merge({}, run.noMin, run[params.env]);
