const gulp = require('gulp');
const hash = require('gulp-hash');
const config = require('../config/gulpfile.config');

/**
 * Questa funzione, dato un tipo di files e un path in cui si trovano,
 * calcola l'hash di ogni file presente nel path (dato dal contenido)
 * e genera un file hashed.json che mette nella cartella dei files hashed
 * @param filesType estensione dei file
 * @param filesPathToCalculateTheHash path in cui trovare i file di cui calcolare l'hash
 * @returns {Promise}
 */
function generateFilesHash(filesType, filesPathToCalculateTheHash) {
    return new Promise(function (resolve, reject) {
        gulp.src(filesPathToCalculateTheHash + "/**/*." + filesType)
            .pipe(hash(config.plugin.js.hashFiles))
            .pipe(hash.manifest(config.names.hashed, config.plugin.js.hashManifest))
            .pipe(gulp.dest(filesPathToCalculateTheHash))
            .on('end', resolve);
    });
}

module.exports = {
    generateFilesHash: generateFilesHash,
};