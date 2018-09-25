#Laravel Base Project
* Repository: git@bitbucket.org:cronycles/LaravelBaseProject.git

## Scaricare per la prima volta il progetto in locale
* scaricare il progetto git
```
$ git clone git@bitbucket.org:cronycles/LaravelBaseProject.git
```
* portarsi con il terminale nella cartella del progetto web:
```
$ cd LaravelBaseProject/LaravelBaseProject
```
* Eseguire i seguenti comandi per installare i pacchetti necessari
```
$ composer install
$ npm install 
$ php artisan vendor:publish
```

* associare al plugin PostCSS i css del progetto

* aggiustare in _.env_ i parametri del db
* lanciare poi
```
$ php artisan migrate
$ php artisan db:seed
```
* lanciare il _gulp_


* dare al play!

## Build per Production
prima di lanciarlo assicurarsi di:
>* avere installato nel proprio pc jq [Use Homebrew to install jq con **brew install jq**]
>* avere il branch develop e master in locale
>* avere il branch develop traked con l'origin [ci si mette in develop e si lancia git branch --set-upstream-to=origin/develop develop ]

* Andare nella cartella _/scripts_ col terminale.
* Lanciare lo script _build.sh_. con una delle seguenti configurazioni:
```
$ ./build.sh onlybuild production public_html
```
>* **onlybuild**: significa che voglio solo fare la cartella build, senza cambi di versione, ne zip
>* **production**: significa che voglio creare minificati etc
>* **public_html**: è il nome che voglio dare alla cartella public in produzione

Lo script si puó lanciare anche col **primo** parametro differente: 
>* **minor:** cambia automaticamente di 1 il numero della versione **minor**, hace una release, la commita e crea il zip file
>* **mayor:** cambia automaticamente di 1 il numero della versione **mayor**, hace una release, la commita e crea il zip file

> Il tutto verrá fatto in modo automatico. Il numero di versione si cambierá solo e verrá fatto il commit di tutto.

* Si eseguiranno una serie di comandi e in seguito si aprirá la cartella _/build.
* Nel frattempo, se definito nei parametri, si creerá uno zip con la versione da applicare.


## Deploy a Production
*Lo zip si puó caricare a mano o automaticamente via ftp con lo script **upload.sh**

* Basterá solo caricare scompattare lo zip direttamente nella cartella e, se tutto fuziona, metterlo nella cartella di backups.

#### N.B. Occhio quando si fanno le operazioni di unzip a non cancellare mail dal server le cartelle che:
* iniziano con il punto (.blablabla)
* backups
* etc
* logs 
* mail
* public_ftp
* public_html
* ssl
* tmp
* access-logs
* www

#### N.B. Occhio ancora e ricordarsi di creare il percorso public/uploads/images. 
Bisogna farlo a mano con filezilla altrimenti non si caricheranno le immagini

##uploadZip.sh
```
$ ./uploadZip.sh
```
caricherá a produzione lo script se presente nella cartella _/build_.
Occhio peró perché dovete modificare prima i parametri dentro lo script 
