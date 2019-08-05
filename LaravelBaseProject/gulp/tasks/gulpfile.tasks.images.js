const {src, dest} = require('gulp');
const flatten = require('gulp-flatten');
const config = require('../config/gulpfile.config');

function appImages() {
    return src(config.paths.src.images.app)
        .pipe(flatten())
        .pipe(dest(config.paths.dest.images.app));
}

module.exports = {
    appImages: appImages
};
