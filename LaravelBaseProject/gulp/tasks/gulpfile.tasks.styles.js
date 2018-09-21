const gulp = require('gulp');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const cssnano = require("gulp-cssnano");
const config = require('../config/gulpfile.config');
const hashManager = require('./gulpfile.tasks.hash');

function appCss() {
    return new Promise(function (resolve, reject) {
        gulp.src(config.paths.src.css.app)
            .pipe(sourcemaps.init())
            .pipe(postcss(config.plugin.css.postcss))
            .pipe(cssnano(config.plugin.css.cssnano))
            .pipe(rename(config.names.css.app))
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest(config.paths.dest.css.app))
            .on('end', resolve);
    });
}

function vendorCss() {
    return new Promise(function (resolve, reject) {
        return gulp.src(config.paths.src.css.vendors)
            .pipe(rename(config.names.css.vendors))
            .pipe(gulp.dest(config.paths.dest.css.vendors))
            .on('end', resolve);
    });
}

function hashCss() {
    return hashManager.generateFilesHash("css", config.paths.dest.css.root);
}

module.exports = {
    appCss: appCss,
    vendorCss: vendorCss,
    hashCss: hashCss
};