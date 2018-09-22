const gulp = require('gulp');
const uglify = require('gulp-uglify');
const gulpif = require('gulp-if');
const sourcemaps = require('gulp-sourcemaps');
const browserify = require('gulp-browserify');
const rename = require('gulp-rename');
const config = require('../config/gulpfile.config');
const hashManager = require('./gulpfile.tasks.hash');

function appJs() {
    return new Promise(function (resolve, reject) {
        gulp.src(config.paths.src.js.app)
            .pipe(sourcemaps.init())
            .pipe(browserify())
            .pipe(gulpif(config.run.js.uglify, uglify(config.plugin.js.uglify)))
            .pipe(rename(config.names.js.app))
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest(config.paths.dest.js.app))
            .on('end', resolve);
    });
}

function authJs() {
    return new Promise(function (resolve, reject) {
        gulp.src(config.paths.src.js.auth)
            .pipe(sourcemaps.init())
            .pipe(browserify())
            .pipe(gulpif(config.run.js.uglify, uglify(config.plugin.js.uglify)))
            .pipe(rename(config.names.js.auth))
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest(config.paths.dest.js.auth))
            .on('end', resolve);
    });
}

function vendorsJs() {
    return new Promise(function (resolve, reject) {
        gulp.src(config.paths.src.js.vendors)
            .pipe(browserify())
            .pipe(rename(config.names.js.vendors))
            .pipe(gulp.dest(config.paths.dest.js.vendors))
            .on('end', resolve);
    });
}

function hashJs() {
    return hashManager.generateFilesHash("js", config.paths.dest.js.root);
}

module.exports = {
    appJs: appJs,
    authJs: authJs,
    vendorsJs: vendorsJs,
    hashJs: hashJs
};