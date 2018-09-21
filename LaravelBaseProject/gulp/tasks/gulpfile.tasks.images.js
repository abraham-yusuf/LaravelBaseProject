const gulp = require('gulp');
const config = require('../config/gulpfile.config');

function appImages () {
    return gulp.src(config.paths.src.images.app)
        .pipe(gulp.dest(config.paths.dest.images.app));
}

module.exports = {
    appImages: appImages
};