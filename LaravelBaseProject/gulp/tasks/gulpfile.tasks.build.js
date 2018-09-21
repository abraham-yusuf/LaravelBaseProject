const gulp = require('gulp');
const rename = require('gulp-rename');
const replace = require('gulp-replace');
const del = require('del');
const fs = require('fs');
const config = require('../config/gulpfile.config');
const composerFile = require('../../composer.json');

function changeMinorVersion() {
    const versionObj = getAppVersionObject();
    versionObj.minor++;
    changeProjectVersion(versionObj);
}

function changeMayorVersion() {
    const versionObj = getAppVersionObject();
    versionObj.mayor++;
    changeProjectVersion(versionObj);
}

function buildProd() {
    return deleteBuildFolder()
        .then(copyAllFilesToBuildFolder)
        .then(copyBuildProdEnvFile)
        .then(addProductionThings)
        .then(cleanUnecessaryBuildFiles)
        .then(function () {
            changePublicFolderName(config.params.pub)
        })
}

function deleteBuildFolder() {
    return del(config.build.root, {force: true, dot: true});
}

//Private Functions

function getAppVersionObject() {
    const version = composerFile.version;
    const myRegexp = /(\d+).(\d+)/g;
    const match = myRegexp.exec(version);

    const mayor = parseInt(match[1]);
    const minor = parseInt(match[2]);

    return {
        mayor: mayor,
        minor: minor
    }
}

function changeProjectVersion(versionObj) {
    newProjectVersion = versionObj.mayor + "." + versionObj.minor;

    gulp.src([config.build.config_app_path])
        .pipe(replace(/('version'\s*=>\s*env\('APP_VERSION',\s*')(.*)('\),)/g, "$1" + newProjectVersion + "$3" ))
        .pipe(gulp.dest("./config/"));

    gulp.src([config.build.composer_json_path])
        .pipe(replace(/("version"\s*:\s*")(.*)(")/g, "$1" + newProjectVersion + "$3"))
        .pipe(gulp.dest("."));

    gulp.src(config.build.all_env_files_path)
        .pipe(replace(/(APP_VERSION=\s*)(.*)/g, "$1" + newProjectVersion))
        .pipe(gulp.dest("."));
}

function copyAllFilesToBuildFolder() {
    return new Promise(function (resolve, reject) {
        gulp.src(config.build.folder_to_copy, {dot: true, base: "."})
            .pipe(gulp.dest(config.build.root))
            .on('end', resolve);
    });

}

function cleanUnecessaryBuildFiles() {
    return del(config.build.files_to_delete, {force: true, dot: true});
}

function copyBuildProdEnvFile() {
    return new Promise(function (resolve, reject) {
        gulp.src(config.build.env.production)
            .pipe(rename('.env'))
            .pipe(gulp.dest(config.build.root))
            .on('end', resolve);
    });
}


function codeForePublicFolderNameChange(newName) {
    return "\
            \t \t$this->app->bind('path.public', function() { \n \
            return base_path().'/" + newName + "'; \n \
        });\n"
}

function changePublicFolderName(newName) {
    if (newName) {
        changeAppServiceProviderPublicFolderName(newName);
        changeBuildPublicFolderName(newName)
    }
    return true;
}

function changeAppServiceProviderPublicFolderName(newName) {
    return gulp.src(config.build.app_providers + "/" + config.build.app_service_provider_name)
        .pipe(replace(/(function\s*register\s*\(\)\s*{)((.|\n)*)}/g, "$1\n" + codeForePublicFolderNameChange(newName) + "$2}"))
        .pipe(gulp.dest(config.build.app_providers));
}

function changeBuildPublicFolderName(newName) {
    return fs.rename(config.build.root + "/" + config.build.public_name,
        config.build.root + "/" + newName, function (err) {
            if (err) {
                console.log(err);
            }
        });
}

function addProductionThings() {
    return new Promise(function (resolve, reject) {
        gulp.src(config.build.production_things, {dot: true})
            .pipe(gulp.dest(config.build.root + "/" + config.build.public_name))
            .on('end', resolve);
    });
}

module.exports = {
    changeMayorVersion: changeMayorVersion,
    changeMinorVersion: changeMinorVersion,
    buildProd: buildProd
};


