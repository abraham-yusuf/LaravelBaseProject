const {src, dest, parallel} = require('gulp');
const replace = require('gulp-replace');
const config = require('../config/gulpfile.config');
const composerFile = require('../../composer.json');

function changeMinorVersion() {
    return increaseProjectVersion();
}

function changeMayorVersion() {
    return increaseProjectVersion(true);
}

//Private Functions

function increaseProjectVersion(isMayor) {
    let versionObject = getCurrentProjectVersionObject();
    if (isMayor) {
        versionObject.mayor++;
    } else {
        versionObject.minor++;
    }
    let newVersion = versionObject.mayor + "." + versionObject.minor;

    return changeProjectVersion(newVersion);
}

function getCurrentProjectVersionObject() {
    let version = composerFile.version;
    let myRegexp = /(\d+).(\d+)/g;
    let match = myRegexp.exec(version);

    let mayor = parseInt(match[1]);
    let minor = parseInt(match[2]);

    return {
        mayor: mayor,
        minor: minor
    }
}

function changeProjectVersion(newVersion) {
    return parallel(
        () => setConfigFileVersion(newVersion),
        () => changeComposerFileVersion(newVersion),
        () => changeEnvFilesVersion(newVersion)
    );
}

function setConfigFileVersion() {
    return src([config.build.config_app_path])
        .pipe(replace(/('version'\s*=>\s*env\('APP_VERSION',\s*')(.*)('\),)/g, "$1" + newProjectVersion + "$3"))
        .pipe(dest("./config/"));
}

function changeComposerFileVersion() {
    return src([config.build.composer_json_path])
        .pipe(replace(/("version"\s*:\s*")(.*)(")/g, "$1" + newProjectVersion + "$3"))
        .pipe(dest("."));
}

function changeEnvFilesVersion() {
    return src(config.build.all_env_files_path)
        .pipe(replace(/(APP_VERSION=\s*)(.*)/g, "$1" + newProjectVersion))
        .pipe(dest("."));
}

module.exports = {
    changeMayorVersion: changeMayorVersion,
    changeMinorVersion: changeMinorVersion
};


