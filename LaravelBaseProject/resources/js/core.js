namespace.add('', function () {
    var core = {};

    core.loadLazyScripts = function() {
        var webConfig = getConfig();
        if (webConfig) {
            lazyJS(webConfig.lazyJs);
        }
    };

    core.setCSRFTokenToHeaders = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    };

    function getConfig() {
        var wconfig = $("#wconfig");
        if (wconfig) {
            return {
                lazyJs: wconfig.data("lj")
            }
        }
        else {
            return null;
        }
    }

    function lazyJS(url) {
        if (url) {
            var script = document.createElement('script');
            script.src = url;
            document.getElementsByTagName('head')[0].appendChild(script);
        }
    }

    return core;

}());
