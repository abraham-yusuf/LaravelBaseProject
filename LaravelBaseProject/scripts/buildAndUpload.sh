#! /bin/sh

#questo script va lanciato cosí:
#./buildAndUpload.sh <releaseType> <envType> <publicFolderName>
#releaseType: mayor o minor (cambia automaticamente il num di versione di 1e fa commit e zip) o onlybuild (non fa nulla, solo crea cartella)
#envType: development o production (per es in prod app.js sará minificato)
#publicFolderName: public o public_html o quello che vuoi

releaseType=$1
envType=$2
publicFolderName=$3

./build.sh ${releaseType} ${envType} ${publicFolderName}
./uploadZip.sh


exit 0
