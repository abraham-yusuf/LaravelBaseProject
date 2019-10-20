//Per lanciare con diversi environments:
// $ gulp <taskname> --env=production

const {series, parallel} = require('gulp');

//Imports
const taskPath = './gulp/tasks';
const cleanTasks = require(taskPath + '/gulpfile.tasks.clean');
const jsTasks = require(taskPath + '/gulpfile.tasks.scripts');
const cssTasks = require(taskPath + '/gulpfile.tasks.styles');
const fontsTasks = require(taskPath + '/gulpfile.tasks.fonts');
const imagesTasks = require(taskPath + '/gulpfile.tasks.images');
const buildTasks = require(taskPath + '/gulpfile.tasks.build');

//Tasks
const js = series(parallel(jsTasks.appJs, jsTasks.lazyJs, jsTasks.authJs, jsTasks.vendorsJs), jsTasks.hashJs);
const css = series(parallel(cssTasks.appCss, cssTasks.vendorCss), cssTasks.hashCss);
const fonts = fontsTasks.appFonts;
const images = imagesTasks.appImages;

const watchJs = () => jsTasks.watchJs(js);
const watchCss = () => jsTasks.watchCss(css);

const clean = parallel(cleanTasks.cleanJs, cleanTasks.cleanCss, cleanTasks.cleanImages, cleanTasks.cleanFonts);
const build = series(parallel(js, css, fonts, images));

const changeMayor = buildTasks.changeMayorVersion;
const changeMinor =  buildTasks.changeMinorVersion;

//Exports
exports.clean = clean;
exports.js = js;
exports.css = css;
exports.fonts = fonts;
exports.images = images;
exports.changeMayor = changeMayor;
exports.changeMinor = changeMinor;
exports.watchJs = watchJs;
exports.watchCss = watchCss;
exports.default = build;
