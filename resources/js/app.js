require('./bootstrap');

/*
|----------------------------------------------------------------
| Vue 3
|----------------------------------------------------------------
*/

import { createApp, h } from 'vue'
import { App, plugin } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init()

const el = document.getElementById('app')

createApp({
    render: () => h(App, {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
    }),
})
    .mixin({
        props: {
            authed: Boolean,
            menuItems: Array,
        },
        methods: {
            route: (name, params, absolute) => route(name, params, absolute, Ziggy),
            setViewHeight: function() {
                let vh = window.innerHeight * 0.01
                document.documentElement.style.setProperty('--vh', `${vh}px`)
            },
        },
        mounted: function() {
            this.setViewHeight()
            window.addEventListener('resize', () => {
                this.setViewHeight()
            })
        },
    })
    .use(plugin)
    .mount(el)
