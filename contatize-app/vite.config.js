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
        host: '0.0.0.0',
        port: 5173,
        proxy: {
            '/resources': {
                target: 'http://localhost:5173', // Redireciona para o servidor Vite
                changeOrigin: true,
                secure: false,
                rewrite: (path) => path.replace(/^\/resources/, ''),
            },
        },
        hmr: {
            host: 'localhost', // HMR deve apontar para localhost
        },
    },
});