import {defineConfig} from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/coffee/page.scss',
            ],
            refresh: [
                ...refreshPaths,
            ],
            buildDirectory: '/coffeeAssets',
        }),
    ],
    css: {
        postcss: {
            plugins: [
                require("tailwindcss/nesting"),
                require("tailwindcss")({
                    config: "./tailwind.coffee.config.js",
                }),
                require("autoprefixer"),
            ],
        },
    },
});
