import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/auth.css', 'resources/css/tailwind-compost.css', 'resources/css/dashboard-admin.css', 'resources/css/welcome.css', 'resources/css/waste.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
