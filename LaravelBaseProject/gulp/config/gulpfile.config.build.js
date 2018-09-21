module.exports = {
    folder_to_copy: [
        "./app/**/*",
        "./bootstrap/**/*",
        "./config/**/*",
        "./public/**/*",
        "./resources/**/*",
        "./routes/**/*",
        "./storage/**/*",
        "./vendor/**/*"
    ],
    files_to_delete: [
        "./build/public/uploads/**",
        "./build/public/uploads/**/*",
        "./build/resources/assets/**/*",
        "./build/storage/framework/cache/**/*",
        "./build/storage/framework/sessions/**/*",
        "./build/storage/framework/views/**/*",
        "./build/storage/logs/**/*"
    ],
    production_things: "./scripts/production/**/*",
    root: "./build",
    public_name: "public",
    app_providers: "./build/app/Providers",
    app_service_provider_name: "AppServiceProvider.php",
    alternative_public_folder_name: "public_html",
    env: {
        production: "./.env.production"
    },
    composer_json_path: "./composer.json",
    config_app_path: "./config/app.php",
    all_env_files_path: "./.env*"
};
