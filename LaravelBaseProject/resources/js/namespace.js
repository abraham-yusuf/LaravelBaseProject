var $W = $W || {};

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