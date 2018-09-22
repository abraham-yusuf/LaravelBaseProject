const lib_path = './node_modules';

const vendors_base_path = {
    font_awesome: lib_path + "/@fortawesome/fontawesome-free"
};
vendors_path = {
    font_awesome: {
        css: vendors_base_path.font_awesome + "/css/all.css",
        fonts: vendors_base_path.font_awesome + "/webfonts/**/*",
    }
};

const assets_base_path = './resources';
const public_path = './public';

const assets_path = {
    js: assets_base_path + "/js",
    css: assets_base_path + "/css",
    images: assets_base_path + "img"
};

module.exports = {
    src: {
        js: {
            vendors: assets_path.js + "/vendors.js",
            app: assets_path.js + "/app.js",
            auth: assets_path.js + "/auth.js"
        },
        css: {
            vendors: assets_path.css + "/vendors.css",
            app: assets_path.css + "/app.css"
        },
        fonts: {
            vendors: [
                vendors_path.font_awesome.fonts
            ]
        },
        images: {
            app: [
                assets_path.images + "/**/*"
            ]
        }
    },
    dest: {
        js: {
            root: public_path + "/js",
            vendors: public_path + "/js/",
            app: public_path + "/js/",
            auth: public_path + "/js/"
        },
        css: {
            root: public_path + "/css",
            vendors: public_path + "/css/",
            app: public_path + "/css/"
        },
        fonts: {
            vendors: public_path + "/webfonts/",
            app: public_path + "/webfonts/",
        },
        images: {
            vendors: public_path + "/img/",
            app: public_path + "/img/",
        },
        public: public_path
    }
};