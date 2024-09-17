import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/js/app.js',
                'resources/js/top.js',
                'resources/js/posts-create.js',
                'resources/js/posts-modal.js',
                'resources/js/company-input.js',
                'resources/js/company-search.js',
            ],
            refresh: true,
        }),
    ],
});
