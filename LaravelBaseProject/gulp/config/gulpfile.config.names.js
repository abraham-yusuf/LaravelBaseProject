const _ = require('lodash');
const params = require('./gulpfile.config.params');

const names = {
    development: {
        js: {
            vendors: "vendors.min.js",
            app: "app.js",
            auth: "auth.js"
        },
        css: {
            vendors: "vendors.min.css",
            app: "app.min.css"
        },
        hashed: "hashed.json"
    },
    production: {
        js: {
            vendors: "vendors.min.js",
            app: "app.min.js",
            auth: "auth.js"
        },
        css: {
            vendors: "vendors.min.css",
            app: "app.min.css"
        },
        hashed: "hashed.json"
    }
};

module.exports = _.merge({}, names.development, names[params.env]);