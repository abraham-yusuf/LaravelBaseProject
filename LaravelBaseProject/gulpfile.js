//Per lanciare con diversi environments:
// $ gulp <taskname> --env=production --pub=public_html

const gulp = require('gulp');

const taskPath = './gulp/tasks';
const clean = require(taskPath + '/gulpfile.tasks.clean');
const js = require(taskPath + '/gulpfile.tasks.scripts');
const css = require(taskPath + '/gulpfile.tasks.styles');
const fonts = require(taskPath + '/gulpfile.tasks.fonts');
const images = require(taskPath + '/gulpfile.tasks.images');
const build = require(taskPath + '/gulpfile.tasks.build');

gulp.task('clean', function () {
    clean.cleanJs();
    clean.cleanCss();
    clean.cleanImages();
    return clean.cleanFonts();
});

gulp.task('js', function () {
    return js.appJs()
        .then(js.lazyJs)
        .then(js.authJs)
        .then(js.vendorsJs)
        .then(js.hashJs);
});

gulp.task('css', function () {
    return css.appCss()
        .then(css.vendorCss)
        .then(css.hashCss);
});

gulp.task('fonts', function () {
    return fonts.appFonts();
});

gulp.task('images', function () {
    return images.appImages();
});

gulp.task('default', ['js', 'css', 'fonts', 'images']);

gulp.task('build:mayor', function () {
    build.changeMayorVersion();
    build.buildProd();
});

gulp.task('build:minor', function () {
    build.changeMinorVersion();
    build.buildProd();
});

gulp.task('build:prod', function () {
    return build.buildProd();
});