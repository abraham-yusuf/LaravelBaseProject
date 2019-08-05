const {src, dest} = require('gulp');
const config = require('../config/gulpfile.config');
const flatten = require('gulp-flatten');

function appFonts() {
    return src(config.paths.src.fonts.app)
        .pipe(flatten())
        .pipe(dest(config.paths.dest.fonts.app));
}

module.exports = {
    appFonts: appFonts
};
