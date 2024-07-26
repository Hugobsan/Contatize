import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        host: '0.0.0.0', // Permite conexões externas
        port: 5173,
        proxy: {
            '/api': {
                target: 'http://127.0.0.1', // Endereço do backend
                changeOrigin: true,
                secure: false,
                logLevel: 'debug',
            },
        },
    },
});
