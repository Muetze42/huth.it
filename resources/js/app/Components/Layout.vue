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
                <Menu as="div" class="menu">
                    <button type="button" class="btn mr-2 desktop:hidden" @click="menuOpen = !menuOpen">
                        <font-awesome-icon icon="fa-sharp fa-solid fa-bars" :class="$page.props.faClass" />
                    </button>
                    <MenuButton class="btn">
                        <span class="sr-only">Switch between Dark & Light Mode</span>
                        <font-awesome-icon icon="fa-sharp fa-solid fa-sun-bright" :class="$page.props.faClass" v-if="this.theme == 'light'"/>
                        <font-awesome-icon icon="fa-sharp fa-solid fa-moon" :class="$page.props.faClass" v-else-if="this.theme == 'dark'"/>
                        <font-awesome-icon icon="fa-sharp fa-solid fa-display" :class="$page.props.faClass" v-else/>
                    </MenuButton>
                    <transition
                        enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0"
                        enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-in"
                        leave-from-class="transform scale-100 opacity-100"
                        leave-to-class="transform scale-95 opacity-0">
                        <MenuItems class="menu-items">
                            <MenuItem class="menu-item" :class="{ 'active': this.theme == 'light' }">
                                <button @click="toggleTheme('light')" type="button">
                                    <font-awesome-icon icon="fa-sharp fa-solid fa-sun-bright" :class="$page.props.faClass" />
                                    Light Mode
                                </button>
                            </MenuItem>
                            <MenuItem class="menu-item" :class="{ 'active': this.theme == 'dark' }">
                                <button @click="toggleTheme('dark')" type="button">
                                    <font-awesome-icon icon="fa-sharp fa-solid fa-moon" :class="$page.props.faClass" />
                                    Dark Mode
                                </button>
                            </MenuItem>
                            <MenuItem class="menu-item" :class="{ 'active': !this.theme }">
                                <button @click="toggleTheme()" type="button">
                                    <font-awesome-icon icon="fa-sharp fa-solid fa-display" :class="$page.props.faClass" />
                                    System
                                </button>
                            </MenuItem>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
            <div>
                <a href="https://stand-with-ukraine.pp.ua/" target="_blank" id="StandWithUkraine">
                    <img src="https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg" alt="StandWithUkraine">
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
                <a class="btn" :href="'https://github.com/Muetze42/huth.it/blob/main/resources/js/app/Pages/'+this.$page.props.section+'/Index.vue'" target="_blank">Edit Vue Component</a>
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
    faDisplay,
    faSunBright,
    faMoon,
    faBars,
    faXmark,
} from '@fortawesome/sharp-solid-svg-icons'
library.add(
    faDisplay,
    faSunBright,
    faMoon,
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
            theme: null,
        }
    },
    methods: {
        toggleTheme(scheme) {
            scheme ? localStorage.theme = scheme : localStorage.removeItem('theme')
            this.applyColorTheme()
        },
        applyColorTheme() {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }

            if (localStorage.theme === 'dark') {
                this.theme = 'dark'
            } else if (localStorage.theme === 'light') {
                this.theme = 'light'
            } else {
                this.theme = null
            }
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
