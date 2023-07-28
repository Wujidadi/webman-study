import { defineConfig, loadEnv } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig(({ command, mode }) => {
    const env = loadEnv(mode, process.cwd(), '');

    const outputFileName = (fileType, withHash = true) => {
        const isProduction = env.APP_ENV === 'production';
        switch (fileType) {
            case 'asset':
                return (isProduction && withHash) ? '[name].css' : '[name].[hash].css';
            case 'chunk':
                return (isProduction && withHash) ? 'chunk-[name].js' : 'chunk-[name].[hash].js';
            case 'entry':
            default:
                return (isProduction && withHash) ? '[name].js' : '[name].[hash].js';
        }
    };

    return {
        server: {
            host: '0.0.0.0',
            port: 5173,
        },
        plugins: [
            vue(),
        ],
        build: {
            outDir: './public/dist',
            copyPublicDir: false,
            manifest: true,
            rollupOptions: {
                input: [
                    './resources/js/app.js',
                    './resources/css/app.scss',
                ],
                output: {
                    dir: './public/dist',
                    entryFileNames: outputFileName('entry'),
                    assetFileNames: outputFileName('asset'),
                    chunkFileNames: outputFileName('chunk'),
                },
            },
        },
        resolve: {
            alias: {
                '@': '/resources',
                'vue': 'vue/dist/vue.esm-bundler.js',
                'vue-i18n': 'vue-i18n/dist/vue-i18n.cjs.js',
            },
        },
    };
});
