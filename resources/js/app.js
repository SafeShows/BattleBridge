import '@mdi/font/css/materialdesignicons.css'

import {createApp, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { md2 } from 'vuetify/blueprints'

const vuetify = createVuetify({
  blueprint: md2,
  theme: {
    defaultTheme: 'dark'
  },
})

import defaultLayout from "./layouts/defaultLayout.vue"

createInertiaApp({
    resolve: async name => {
        const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
        let page = pages[`./pages/${name}.vue`]
        page.default.layout = page.default.layout || defaultLayout
        return page
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(vuetify)
            .mount(el)
    },
})