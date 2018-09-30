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
