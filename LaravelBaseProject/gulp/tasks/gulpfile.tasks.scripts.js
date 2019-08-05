const {src, dest, watch} = require('gulp');

const uglify = require('gulp-uglify');
const gulpif = require('gulp-if');
const sourcemaps = require('gulp-sourcemaps');
const browserify = require('gulp-browserify');
const rename = require('gulp-rename');
const config = require('../config/gulpfile.config');
const hashManager = require('./gulpfile.tasks.hash');

function appJs() {
    return src(config.paths.src.js.app)
        .pipe(sourcemaps.init())
        .pipe(browserify())
        .pipe(gulpif(config.run.js.uglify, uglify(config.plugin.js.uglify)))
        .pipe(rename(config.names.js.app))
        .pipe(sourcemaps.write('.'))
        .pipe(dest(config.paths.dest.js.app));
}


function lazyJs() {
    return src(config.paths.src.js.lazy)
        .pipe(sourcemaps.init())
        .pipe(browserify())
        .pipe(gulpif(config.run.js.uglify, uglify(config.plugin.js.uglify)))
        .pipe(rename(config.names.js.lazy))
        .pipe(sourcemaps.write('.'))
        .pipe(dest(config.paths.dest.js.lazy));
}

function authJs() {
    return src(config.paths.src.js.auth)
        .pipe(sourcemaps.init())
        .pipe(browserify())
        .pipe(gulpif(config.run.js.uglify, uglify(config.plugin.js.uglify)))
        .pipe(rename(config.names.js.auth))
        .pipe(sourcemaps.write('.'))
        .pipe(dest(config.paths.dest.js.auth));
}

function vendorsJs() {
    return src(config.paths.src.js.vendors)
        .pipe(browserify())
        .pipe(rename(config.names.js.vendors))
        .pipe(dest(config.paths.dest.js.vendors));
}

function hashJs() {
    return hashManager.generateFilesHash("js", config.paths.dest.js.root);
}

function watchJs(taskToRun) {
    watch(config.paths.src.js.all, taskToRun);
}

module.exports = {
    appJs: appJs,
    lazyJs: lazyJs,
    authJs: authJs,
    vendorsJs: vendorsJs,
    hashJs: hashJs,
    watchJs: watchJs
};
