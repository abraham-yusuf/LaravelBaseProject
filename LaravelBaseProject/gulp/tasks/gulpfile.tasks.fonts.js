const gulp = require('gulp');
const config = require('../config/gulpfile.config');

function vendorFonts() {
    return gulp.src(config.paths.src.fonts.vendors)
        .pipe(gulp.dest(config.paths.dest.fonts.vendors));
}

module.exports = {
    vendorFonts: vendorFonts
};