import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS
                'resources/css/app.css',
                'resources/css/auth.css',
                // JS
                'resources/js/app.js',
                'resources/js/aliados.js',
                'resources/js/conciliaciones.js',
            ],
            refresh: true,
        }),
    ],
});