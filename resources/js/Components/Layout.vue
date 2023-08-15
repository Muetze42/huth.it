<template>
    <TransitionRoot as="template" :show="menuOpen">
        <Dialog as="div" class="mobile-nav" @close="menuOpen = false">
            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300"
                             leave-from="opacity-100" leave-to="opacity-0">
                <DialogOverlay class="mobile-overlay"/>
            </TransitionChild>
            <TransitionChild class="mobile-menu" as="div" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0"
                             leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                <div class="text-right">
                    <button type="button" class="btn" @click="menuOpen = false">
                        <font-awesome-icon icon="fa-sharp fa-solid fa-xmark" :class="$page.props.faClass" />
                    </button>
                </div>
                <MainMenu />
            </TransitionChild>
        </Dialog>
    </TransitionRoot>
    <header>
        <div class="container">
            <div>
                <div class="menu">
                    <button type="button" class="btn mr-2 desktop:hidden" @click="menuOpen = !menuOpen">
                        <font-awesome-icon icon="fa-sharp fa-solid fa-bars" :class="$page.props.faClass" />
                        <span class="sr-only">Open Mobile Menu</span>
                    </button>
                    <button type="button" class="btn" v-if="lightTheme" @click="toggleTheme(false)">
                        <font-awesome-icon  icon="fa-sharp fa-solid fa-lightbulb-on" class="fa-fw" :class="$page.props.faClass" />
                        <span class="sr-only">Deactivate Light Theme</span>
                    </button>
                    <button v-else type="button" class="btn" @click="toggleTheme()">
                        <font-awesome-icon icon="fa-sharp fa-solid fa-lightbulb" class="fa-fw" :class="$page.props.faClass" />
                        <span class="sr-only">Activate Light Theme</span>
                    </button>
                </div>
            </div>
            <div>
                <a href="https://stand-with-ukraine.pp.ua/" target="_blank">
                    <img src="/assets/stand-with-ukraine.svg" alt="StandWithUkraine">
                </a>
                <div class="h-1"></div>
                <a href="https://linktr.ee/CurrentPetitionsFreeIran" target="_blank">
                    <img src="/assets/iran-banner.svg" alt="Current petitions for Iran" class="top-banner">
                </a>
            </div>
        </div>
    </header>
    <main class="container o">
        <nav class="left-nav">
            <MainMenu />
        </nav>
        <div class="content">
            <slot/>
            <div class="github-action">
                <span>
                    <font-awesome-icon :icon="'fa-brands fa-github'" class="fa-fw" />
                </span>
                <a class="btn" :href="'https://github.com/Muetze42/huth.it/blob/main/app/Http/Controllers/app/'+this.$page.props.section+'Controller.php'" target="_blank">Edit Controller</a>
                <a class="btn" :href="'https://github.com/Muetze42/huth.it/blob/main/resources/js/Pages/'+this.$page.props.section+'/Index.vue'" target="_blank">Edit Vue Component</a>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <Footer />
        </div>
    </footer>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import MainMenu from './../Components/MainMenu.vue';
import Footer from './../Components/Footer.vue';
/* FontAwesome START */
import {library} from '@fortawesome/fontawesome-svg-core'
import {
    faLightbulb,
    faLightbulbOn,
    faBars,
    faXmark,
} from '@fortawesome/sharp-solid-svg-icons'
library.add(
    faLightbulb,
    faLightbulbOn,
    faBars,
    faXmark,
);
/* FontAwesome END */
/* "Headless UI START */
import {
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
    DialogDescription,
    DialogOverlay,
} from '@headlessui/vue'
/* "Headless UI End */

export default {
    name: "Layout",
    components: {
        MainMenu,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        Footer,
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
        DialogDescription,
        DialogOverlay,
    },
    data() {
        return {
            menuOpen: false,
            lightTheme: localStorage.getItem('lightTheme') === '1',
        }
    },
    methods: {
        toggleTheme(lightTheme = true) {
            lightTheme ? localStorage.setItem('lightTheme', '1') : localStorage.removeItem('lightTheme')
            this.lightTheme = lightTheme
            this.applyColorTheme()
        },
        applyColorTheme() {
            this.lightTheme ? document.documentElement.classList.remove('dark') : document.documentElement.classList.add('dark')
        },
    },
    mounted() {
        this.applyColorTheme()
        Inertia.on("navigate", (event) => {
            this.menuOpen = false
        });
    },
    updated() {
        document.title = this.$page.props.pageTitle
    }
}
</script>
