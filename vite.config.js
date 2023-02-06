import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import vuetify from 'vite-plugin-vuetify'
import VueMacros from 'unplugin-vue-macros/vite'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        VueMacros({
            plugins: {
                vue: vue(),
            },
        }),
        vuetify(),
    ],
});