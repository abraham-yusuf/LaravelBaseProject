const gulp = require('gulp');
const config = require('../config/gulpfile.config');
const flatten = require('gulp-flatten');

function appFonts() {
    return gulp.src(config.paths.src.fonts.app)
        .pipe(flatten())
        .pipe(gulp.dest(config.paths.dest.fonts.app));
}

module.exports = {
    appFonts: appFonts
};