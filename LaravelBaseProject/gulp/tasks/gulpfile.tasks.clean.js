const del = require('del');
const config = require('../config/gulpfile.config');

function cleanJs() {
    return del([config.paths.dest.js.app, config.paths.dest.js.vendors]);
}

function cleanCss() {
    return del([config.paths.dest.css.app, config.paths.dest.css.vendors]);
}

function cleanImages() {
    return del([config.paths.dest.images.app, config.paths.dest.images.vendors]);
}

function cleanFonts() {
    return del([config.paths.dest.fonts.app, config.paths.dest.fonts.vendors]);
}

module.exports = {
    cleanJs: cleanJs,
    cleanCss: cleanCss,
    cleanImages: cleanImages,
    cleanFonts: cleanFonts
};
