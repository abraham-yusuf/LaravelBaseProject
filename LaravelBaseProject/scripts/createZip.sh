#! /bin/bash

#vedere build.sh

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m' # No Color

clear

printf "\n${GREEN} - Create .zip of the build folder:${NC}\n"

appName=$1;
appVersion=$2;

zipFileName="${appName}_v${appVersion}.zip"

zip -r ./build/$zipFileName ./build

exit 0
