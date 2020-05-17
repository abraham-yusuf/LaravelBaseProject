#Cro Device Images Helper

##Descrizione
Aiuta a settare le immagini di un container che gli si passa da __data-m__ o __data-d__ a __data-src__

##Installazione
- Importare il js dove vi serve:
```js
import CroDeviceImagesHelper from "../cro-device-images-helper/cro.device.images.helper";
```
- poi inizializzare l'oggetto passandogli un __container__ che contiene le immagini da trattare
```js
const croDeviceImagesHelper = new CroDeviceImagesHelper(".containerSelector");
```
- e lanciare quando si vuole, la funzione __setImagesBasedOnScreen()__:
```js
croDeviceImagesHelper.setImagesBasedOnScreen();
```
- nell'html ovviamente dovrá esserci un container qualsiasi con dentro immagini:
```html
<div class="containerSelector">
...
<img data-d="https://via.placeholder.com/1920x1080.png" data-m="https://via.placeholder.com/1080x1920.png">

</div>
```

E lui poi quando si lancia la funzione, metterá, dependendo dalle dimensioni dello schermo,
una delle due immagini dentro l'attributo __data-src__
