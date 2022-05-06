import {createApp, h} from 'vue'
import {createInertiaApp, Link} from '@inertiajs/inertia-vue3'
import {InertiaProgress} from '@inertiajs/progress'
import Layout from './Components/Layout'

/* Font Awesome */
import {library} from "@fortawesome/fontawesome-svg-core";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faInstagram, faTwitch, faGithub, faLinkedin, faXing, faRedditAlien, faLaravel, faYoutube} from "@fortawesome/free-brands-svg-icons";
import {faBrightness, faMoon, faBars, faXmark, faCaretRight, faCaretDown, faEllipsisVertical, faArrowsRotate, faElephant} from "@fortawesome/pro-regular-svg-icons";
import {faAt} from "@fortawesome/pro-light-svg-icons";
library.add(
    faTwitch,
    faInstagram,
    faBrightness,
    faMoon,
    faGithub,
    faLinkedin,
    faXing,
    faRedditAlien,
    faAt,
    faBars,
    faXmark,
    faLaravel,
    faYoutube,
    faCaretRight,
    faCaretDown,
    faEllipsisVertical,
    faArrowsRotate,
    faElephant,
);

createInertiaApp({
    resolve: async name => {
        let page = (await import(`./Pages/${name}`)).default;

        if (page.layout === undefined) {
            page.layout = Layout;
        }

        return page;
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .component("Link", Link)
            .component("font-awesome-icon", FontAwesomeIcon)
            .mount(el)
    }
})

InertiaProgress.init({
    delay: 300,
    color: '#0ea5e9',
    includeCSS: true,
    showSpinner: true,
})
