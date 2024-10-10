import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',  // Permet à Vite d'être accessible sur le réseau
        port: 5178,       // Le port utilisé par Vite
        cors: true,       // Activer les requêtes CORS
        hmr: {
            host: '172.22.114.110', // Remplace par l'adresse IP de ton ordinateur sur le réseau local
            port: 5178,             // Assure-toi que c'est le même port que celui défini plus haut
        },
    },
});
