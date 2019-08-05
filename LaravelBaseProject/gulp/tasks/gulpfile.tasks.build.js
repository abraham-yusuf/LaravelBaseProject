const {src, dest, series, parallel} = require('gulp');
const rename = require('gulp-rename');
const replace = require('gulp-replace');
const del = require('del');
const fs = require('fs');
const config = require('../config/gulpfile.config');
const composerFile = require('../../composer.json');

function buildProd() {
    return series(
        deleteBuildFolder,
        copyAllFilesToBuildFolder,
        copyBuildProdEnvFile,
        addProductionThings,
        cleanUnecessaryBuildFiles,
        changePublicFolderName
    )
}

function changeMinorVersion() {
    return increaseProjectVersion();
}

function changeMayorVersion() {
    return increaseProjectVersion(true);
}

//Private Functions

function deleteBuildFolder() {
    return del(config.build.root, {force: true, dot: true});
}

function copyAllFilesToBuildFolder() {
    return src(config.build.folder_to_copy, {dot: true, base: "."})
        .pipe(dest(config.build.root));
}

function copyBuildProdEnvFile() {
    return src(config.build.env.production)
        .pipe(rename('.env'))
        .pipe(dest(config.build.root));
}

function addProductionThings() {
    return src(config.build.production_things, {dot: true})
        .pipe(dest(config.build.root + "/" + config.build.public_name));
}

function cleanUnecessaryBuildFiles() {
    return del(config.build.files_to_delete, {force: true, dot: true});
}

function changePublicFolderName() {
    var publicFolderName = config.params.pub;
    if (publicFolderName) {
        changeAppServiceProviderPublicFolderName(publicFolderName);
        changeBuildPublicFolderName(publicFolderName)
    }
    return true;
}

function changeAppServiceProviderPublicFolderName(newName) {
    return src(config.build.app_providers + "/" + config.build.app_service_provider_name)
        .pipe(replace(/(function\s*register\s*\(\)\s*{)((.|\n)*)}/g, "$1\n" + codeForePublicFolderNameChange(newName) + "$2}"))
        .pipe(dest(config.build.app_providers));
}

function changeBuildPublicFolderName(newName) {
    return fs.rename(config.build.root + "/" + config.build.public_name,
        config.build.root + "/" + newName, function (err) {
            if (err) {
                console.log(err);
            }
        });
}

function codeForePublicFolderNameChange(newName) {
    return "\
            \t \t$this->app->bind('path.public', function() { \n \
            return base_path().'/" + newName + "'; \n \
        });\n"
}

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
    changeMinorVersion: changeMinorVersion,
    buildProd: buildProd
};


