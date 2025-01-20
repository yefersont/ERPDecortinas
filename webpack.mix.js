const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .react() // Habilitar React
    .sass("resources/sass/app.scss", "public/css")
    .version(); // Para habilitar el cache busting (opcional)
