#! /bin/sh

#questo script va lanciato cosí:
#./build.sh <releaseType> <envType> <publicFolderName>
#releaseType: mayor o minor (cambia automaticamente il num di versione di 1e fa commit e zip) o onlybuild (non fa nulla, solo crea cartella)
#envType: development o production (per es in prod app.js sará minificato)
#publicFolderName: public o public_html o quello che vuoi

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m' # No Color

clear

printf "${BLUE}****************************************************************************\n"
printf "********************* PROJECT VERSION BUILDING SCRIPT ************************\n"
printf "****************************************************************************\n"

releaseType=$1
envType=$2
publicFolderName=$3

printf "\n${YELLOW} Version release type:${NC}${releaseType}\n"
printf "\n${YELLOW} Env type:${NC}${envType}\n"
printf "\n${YELLOW} Public folder name:${NC}${publicFolderName}\n"

printf "\n${GREEN} - Going to the project folder:${NC}\n"

cd ../

pwd

printf "\n"

printf "\n${GREEN} - Updating develop branch:${NC}\n"

git checkout develop

git pull

printf "\n${GREEN} - Launch things for cleaning laravel things:${NC}\n"

php artisan view:clear
composer dump-autoload --optimize
php artisan config:cache

printf "\n${GREEN} - Building a new app version:${NC}\n"

gulp --env=${envType}

gulpReleaseType=${releaseType};

if [ "$releaseType" == "onlybuild" ]; then
      gulpReleaseType="prod"
    fi

gulp build:${gulpReleaseType} --pub=${publicFolderName}

appName=($(jq -r '.name' composer.json))
appVersion=($(jq -r '.version' composer.json))

if [ "$releaseType" != "onlybuild" ]; then
    cd scripts/
    ./commitAndZip.sh ${appName} ${appVersion}
fi


printf "${NC}\n"

exit 0
