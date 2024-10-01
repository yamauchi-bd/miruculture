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
                'resources/js/company-input.js',
                'resources/js/company-search.js',
                'resources/js/company-show.js',
                'resources/js/company-chart.js',
                'resources/js/posts-step1.js',
                'resources/js/posts-step2.js',
                'resources/js/posts-step3.js',
            ],
            refresh: true,
        }),
    ],
});
