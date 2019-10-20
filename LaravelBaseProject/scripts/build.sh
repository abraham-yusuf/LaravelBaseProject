#! /bin/sh

#questo script va lanciato cosí:
#./build.sh <releaseType>
#releaseType:
# -M crea una mayor release e fa il commit di tutto,
# -m crea una minor release e fa il commit di tutto,
# se non passo nessun parametro solo fa il build

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

clear

printf "${BLUE}***************************************************************\n"
printf "********************* PROJECT BUILDING SCRIPT ************************\n"
printf "**********************************************************************\n"

if [ "$*" = "*-M*" ]; then
  releaseType='mayor';
elif [ "$*" = "*-m*" ]; then
  releaseType='minor';
else
  releaseType='onlybuild';
fi

printf "\n${YELLOW} Version release type:${NC}\n"

printf "${releaseType}\n";

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

if [ "${releaseType}" = 'mayor' ]; then
  gulp changeMayorVersion
elif [ "${releaseType}" = 'minor' ]; then
  gulp changeMinorVersion
else
  gulp default
fi

appVersion=($(jq -r '.version' composer.json))

if [ "$releaseType" != "onlybuild" ]; then
    scripts/commitVersionAndTag.sh ${appVersion}
fi

printf "${NC}\n"

exit 0
