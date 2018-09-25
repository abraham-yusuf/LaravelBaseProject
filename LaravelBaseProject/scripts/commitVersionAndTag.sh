#! /bin/bash

#vedere build.sh

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m' # No Color

clear

appName=$1;
appVersion=$2;

printf "\n${GREEN} - Commit the new app version ${appVersion} change:${NC}\n"

git commit -am "changing release version to: v${appVersion}"

git tag -a v${appVersion} -m "v${appVersion}"

git push

git push origin --tags

git checkout master

git pull

git merge develop

git push

git push origin --tags

git checkout develop

git merge master

git push

printf "${NC}\n"

exit 0
