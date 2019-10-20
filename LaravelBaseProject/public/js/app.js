(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
namespace.add('', function () {
    let core = {};

    //Selectors
    const clientServerSelector = "#cl-srv";

    core.loadLazyScripts = function () {
        let clSrvConfig = getClientServerConfig();
        if (clSrvConfig) {
            lazyJS(clSrvConfig.lazyJs);
        }
    };

    core.setCSRFTokenToHeaders = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    };

    function getClientServerConfig() {
        let clSrvConfig = $(clientServerSelector);
        if (clSrvConfig) {
            return {
                lazyJs: clSrvConfig.data("lj")
            }
        }
        else {
            return null;
        }
    }

    function lazyJS(url) {
        if (url) {
            let script = document.createElement('script');
            script.src = url;
            document.getElementsByTagName('head')[0].appendChild(script);
        }
    }

    return core;

}());

},{}],2:[function(require,module,exports){
require('./modules');

$(function () {
    $W.setCSRFTokenToHeaders();
    $W.loadLazyScripts();
});

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
},{"./modules":3}],3:[function(require,module,exports){
require('./namespace');
require('./core');
},{"./core":1,"./namespace":4}],4:[function(require,module,exports){
(function (global){
﻿var $W = $W || {};

var namespace = function () {

    //Funcion que crea namespace
    function add(namespaceCustom, objectToSet) {
        //Se detecta el entorno, ya que en el servidor no existe window
        var hasWindow = false;
        if (typeof (window) != "undefined") {
            hasWindow = true;
        }

        //Si es la raiz, se asigna el objeto
        if (namespaceCustom.length === 0) {
            if (hasWindow) {
                window.$W = objectToSet;
            }
            else {
                global.$W = objectToSet;
            }
        }
        else {
            var nameOfNamespaceList = namespaceCustom.split('.');

            var objectNamespace = $W;
            if (hasWindow) {
                objectNamespace = window.$W;
            }
            else {
                objectNamespace = global.$W;
            }

            for (var i = 0, len = nameOfNamespaceList.length; i < len; i++) {
                //Si es el ultimo, se asigna el objeto
                if (i == (len - 1)) {
                    //Se asigna el objeto al namespace
                    objectNamespace = addNamespaceAndAsign(objectNamespace, nameOfNamespaceList[i], objectToSet); //Se agrega el namespace al objeto
                }
                else {
                    //Solo se crea el namespace
                    objectNamespace = addNamespace(objectNamespace, nameOfNamespaceList[i]); //Se agrega el namespace al objeto
                }
            }
            objectNamespace.className = nameOfNamespaceList.join(".");
        }

        //Se reasigna al final de la creacion
        if (hasWindow) {
            $W = window.$W;
        }
        else {
            $W = global.$W;
        }

    }

    //Funcion que agrega un namespace a un objeto dado
    function addNamespace(object, nameOfNamespace) {
        object[nameOfNamespace] = object[nameOfNamespace] || {};
        return object[nameOfNamespace];
    }

    //Funcion que agrega un namespace a un objeto dado
    function addNamespaceAndAsign(object, nameOfNamespace, objectToAsign) {

        var existingObject = object[nameOfNamespace];

        //Si ya existía ese espacio de nombres, pasamos las propiedades que tenía a "objectToAsign"
        if (existingObject) {
            //Pasamos cada propiedad al nuevo objeto a asignar
            Object.keys(existingObject).forEach(function (key) {
                objectToAsign[key] = existingObject[key];
            });
        }

        //El nuevo objeto será el que hemos pasado
        object[nameOfNamespace] = objectToAsign;
        existingObject = null;

        return object[nameOfNamespace];
    }

    return {
        add: add
    };
}();

//En el servidor no existe window
if (typeof (window) == "undefined") {
    global.$W = $W;
    global.namespace = namespace;
}
else {
    window.$W = $W;
    window.namespace = namespace;
}
}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}]},{},[2])
//# sourceMappingURL=app.js.map
