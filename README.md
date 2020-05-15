#Laravel Base Project
* Repository: git@github.com:cronycles/LaravelBaseProject.git

## Scaricare per la prima volta il progetto in locale
* scaricare il progetto git
```
$ git clone git@github.com:cronycles/LaravelBaseProject.git
```
* portarsi con il terminale nella cartella del progetto web:
```
$ cd LaravelBaseProject
```
* Eseguire i seguenti comandi per installare i pacchetti necessari
```
$ npm install
$ composer install
$ composer update --no-scripts
```
* Adesso PHP Artisan:
```
php artisan vendor:publish --provider="Spatie\Translatable\TranslatableServiceProvider"
php artisan config:cache
```
* associare al plugin PostCSS i css del progetto (si fa nelle preferenze del PhpStorm)

### .env file
Il file non sta nel repository per ovvie ragioni di password. 
Peró per lanciare il progetto Laravel avete bisogno di un file **.env**.
I file per il progetto si trovano nella **wiki personale**, precisamente nella sezione **http://www.crointhemorning.com/wiki/index.php/Crointhemorning#LaravelBaseProject**
* creare dunque il file _.env_ e copiarne il contenuto dalla wiki
* aprire il nuovo file creato
* aggiustare i parametri, soprattutto quelli del db
* lanciare poi

```
php artisan key:generate
php artisan config:cache
```
* assicuratevi che dentro il vostro .env abbia generato la chiave della app in *APP_KEY*
* dopodiché lanciate:

```
$ php artisan migrate
$ php artisan db:seed
```
* lanciare il _npm run dev_

* dare al play:
```
 $ php artisan serve
```

## Deploy a Production
prima di lanciarlo assicurarsi di:
>* avere installato nel proprio pc jq [Usa Homebrew con **brew install jq**]
>* avere il branch **develop** e **master** in locale
>* avere il branch **develop** tracked con **origin**
>>* aver tolto dal ```.gitignore``` le cartelle:
 >>* vendor
 >>* public/js
 >>* public/css
 >>* public/fonts
 >>* public/mix-manifest.json

* Aprire il terminale

```
cd scripts
./build.sh

```
> Lo script __build.sh__ puó essere lanciato con o senza parametri. Se si lancia senza parametri non verrá cambiato il numero di versione
> Se si lancia con il parametro -m allora si creerá una versione Minor della app.
> Se si lancia con il parametro -M allora si creerá una versione Mayor della app.

* Automaticamente verrá fatto il merge con master, creato un tag con la versione e fatto commit e push al repository.
* Poi bisognerá solo andare nel **CPanel** del vostro provider, nella sezione **Git Version Control**.
* Vedrete che c'è gia un repository con un bottone **Gestione**, cliccarlo.
* Vi si aprirá una pagina con due tabs, andare al tab **Pull or Deploy**
* Cliccare in ordine i 2 bottoni: **Update from remote** e poi **Deploy HEAD commit**
Tutto il deploy lo fará solo grazie al file che avete in questo progetto chiamato **.cpanel.yml**

## CDN
Per comoditá le immagini del progetto uploaded e gli eventuali files sono stati messi in un subdominio chiamato **cdn.larvalbaseproject.com**.
Tutto questo serve per non tenere i file dentro il progetto stesso, che creerebbero casini alla ora di fare deploy o eliminare cose.
