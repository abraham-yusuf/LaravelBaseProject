#!/bin/sh

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m' # No Color

clear

createFolderIfNotExists() {
    local r
    local a
    r="$@"
    if [ "$r" != "$a" ]; then
      a=${r%%/*}
      echo "mkdir $a"
    fi

}

printf "${BLUE}***************************************************************\n"
printf "********************** PROJECT UPLOADING ZIP *************************\n"
printf "**********************************************************************\n"

source ftp.conf

BUILD_FOLDER='../build'
BACKUPS_FOLDER_NAME="backups"

find "$BUILD_FOLDER" -maxdepth 1 -type f -iname '*.zip' | while read FILE; do
	printf "\n${YELLOW} The file to upload is:${NC}\n"
	printf "$FILE\n";

	fileBasename=$(basename $FILE)

	printf "\n${GREEN} 1. Uploading the file:${NC}\n"

	ftp -n $HOST <<END_SCRIPT
	quote USER $USER
	quote PASS $PASSWD
	binary
	$(createFolderIfNotExists "$BACKUPS_FOLDER_NAME")
	put $FILE $fileBasename
	quit
END_SCRIPT

done

#unzip -lqq "$FILE" '*_xx.xml' >/dev/null && echo mv -v "$FILE" "$ANOTHER"/


