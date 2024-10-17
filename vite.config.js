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
                'resources/js/create-enrollment-record.js',
                'resources/js/create_deciding_factors.js',
                'resources/js/create_company_cultures.js',
            ],
            refresh: true,
        }),
    ],
});
