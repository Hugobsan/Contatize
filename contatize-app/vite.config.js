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
        host: 'http://129.148.62.231',
        port: 5173,
        proxy: {
            '/resources': {
                target: 'http://129.148.62.231',
                changeOrigin: false,
                secure: false,
                rewrite: (path) => path.replace(/^\/resources/, ''),
            },
        },
    },
});
