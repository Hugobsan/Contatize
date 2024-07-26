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
        strictPort: true,
        proxy: {
            '/app': {
                target: 'http://localhost',
                changeOrigin: true,
                secure: false,
            },
        },
        hmr: {
            host: 'localhost',
        },
    }
});
