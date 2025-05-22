import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',   
                'node_modules/toastr/build/toastr.min.css',
                'node_modules/toastr/build/toastr.min.js',
            ],
            refresh: true,
        }),
    ],
});
