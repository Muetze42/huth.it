import {createApp, h} from 'vue';
import {createInertiaApp, Link} from '@inertiajs/inertia-vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {InertiaProgress} from '@inertiajs/progress'
import Layout from './Components/Layout.vue'
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {library} from '@fortawesome/fontawesome-svg-core'
import {
    faGithub,
    faLaravel,
} from '@fortawesome/free-brands-svg-icons'
library.add(
    faGithub,
    faLaravel,
);

createInertiaApp({
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );
        page.then((module) => {
            module.default.layout = module.default.layout || Layout;
        });
        return page;
    },
    setup({el, App, props, plugin}) {
        const VueApp = createApp({render: () => h(App, props)})

        VueApp
            .use(plugin)
            .component("Link", Link)
            .component("font-awesome-icon", FontAwesomeIcon,)
            .mount(el)
    },
});

InertiaProgress.init({
    // delay: 300,
    color: '#22c55e',
    // includeCSS: true,
    // showSpinner: true,
})
