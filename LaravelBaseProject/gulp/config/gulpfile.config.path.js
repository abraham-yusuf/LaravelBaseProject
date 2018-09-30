const assets_base_path = './resources';
const public_path = './public';

const assets_path = {
    js: assets_base_path + "/js",
    css: assets_base_path + "/css",
    fonts: assets_base_path + "/fonts",
    images: assets_base_path + "img"
};

module.exports = {
    src: {
        js: {
            vendors: assets_path.js + "/vendors.js",
            app: assets_path.js + "/app.js",
            lazy: assets_path.js + "/lazy.js",
            auth: assets_path.js + "/auth.js"
        },
        css: {
            vendors: assets_path.css + "/vendors.css",
            app: assets_path.css + "/app.css"
        },
        fonts: {
            app: [assets_path.fonts + "/**/*.{ttf,woff,woff2,eof,eot,svg}"]
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
            lazy: public_path + "/js/",
            auth: public_path + "/js/"
        },
        css: {
            root: public_path + "/css",
            vendors: public_path + "/css/",
            app: public_path + "/css/"
        },
        fonts: {
            app: public_path + "/fonts/",
        },
        images: {
            vendors: public_path + "/img/",
            app: public_path + "/img/",
        },
        public: public_path
    }
};