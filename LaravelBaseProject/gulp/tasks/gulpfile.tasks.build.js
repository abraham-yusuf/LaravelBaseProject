const {src, dest, parallel} = require('gulp');
const replace = require('gulp-replace');
const config = require('../config/gulpfile.config');
const composerFile = require('../../composer.json');

async function changeMinorVersion() {
    return await increaseProjectVersion();
}

async function changeMayorVersion() {
    return await increaseProjectVersion(true);
}

//Private Functions

async function increaseProjectVersion(isMayor) {
    let versionObject = getCurrentProjectVersionObject();
    if (isMayor) {
        versionObject.mayor++;
    } else {
        versionObject.minor++;
    }
    let newVersion = versionObject.mayor + "." + versionObject.minor;

    return await changeProjectVersion(newVersion);
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

async function changeProjectVersion(newVersion) {
    await setConfigFileVersion(newVersion);
    await changeComposerFileVersion(newVersion);
    return await changeEnvFilesVersion(newVersion);
}


async function setConfigFileVersion(newVersion) {
    return src([config.build.config_app_path])
        .pipe(replace(/('version'\s*=>\s*env\('APP_VERSION',\s*')(.*)('\),)/g, "$1" + newVersion + "$3"))
        .pipe(dest("./config/"));
}

async function changeComposerFileVersion(newVersion) {
    return src([config.build.composer_json_path])
        .pipe(replace(/("version"\s*:\s*")(.*)(")/g, "$1" + newVersion + "$3"))
        .pipe(dest("."));
}

async function changeEnvFilesVersion(newVersion) {
    return src(config.build.all_env_files_path)
        .pipe(replace(/(APP_VERSION=\s*)(.*)/g, "$1" + newVersion))
        .pipe(dest("."));
}


module.exports = {
    changeMayorVersion: changeMayorVersion,
    changeMinorVersion: changeMinorVersion
};


