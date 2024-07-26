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
        host: '0.0.0.0', // permite conexões externas
        port: 5173,
        proxy: {
            '/resources': {
                target: 'http://129.148.62.231:5173', // ajuste para o IP público
                changeOrigin: true,
                secure: false,
                rewrite: (path) => path.replace(/^\/resources/, ''),
            },
        },
    },
});
