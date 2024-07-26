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
        host: 'http://localhost:5173',
        port: 5173,
        proxy: {
            '/resources': {
                target: '0.0.0.0',
                changeOrigin: true,
                secure: false,
                rewrite: (path) => path.replace(/^\/resources/, ''),
            },
        },
    },
});
