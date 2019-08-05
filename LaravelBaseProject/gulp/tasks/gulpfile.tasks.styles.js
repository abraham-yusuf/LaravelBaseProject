const {src, dest, watch} = require('gulp');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const cssnano = require("gulp-cssnano");
const config = require('../config/gulpfile.config');
const hashManager = require('./gulpfile.tasks.hash');

function appCss() {
    return src(config.paths.src.css.app)
        .pipe(sourcemaps.init())
        .pipe(postcss(config.plugin.css.postcss.app))
        .pipe(cssnano(config.plugin.css.cssnano))
        .pipe(rename(config.names.css.app))
        .pipe(sourcemaps.write('.'))
        .pipe(dest(config.paths.dest.css.app));
}

function vendorCss() {
    return src(config.paths.src.css.vendors)
        .pipe(postcss(config.plugin.css.postcss.vendors))
        .pipe(rename(config.names.css.vendors))
        .pipe(dest(config.paths.dest.css.vendors));
}

function hashCss() {
    return hashManager.generateFilesHash("css", config.paths.dest.css.root);
}

function watchCss(taskToRun) {
    return watch(config.paths.src.css.all, taskToRun);
}

module.exports = {
    appCss: appCss,
    vendorCss: vendorCss,
    hashCss: hashCss,
    watchCss: watchCss
};
