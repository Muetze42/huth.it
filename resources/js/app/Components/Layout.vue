<template>
    <div v-if="menuOpen" class="absolute bg-secondary dark:bg-secondary-dark z-40 top-12 w-full h-full temp">
        <MainMenu />
    </div>
    <header>
        <div class="container">
            <Menu as="div" class="menu">
                <button type="button" class="btn mr-2 content:hidden" @click="menuOpen = !menuOpen">
                    <FontAwesomeIcon :icon="[$page.props.faIcon, 'fa-bars']" :class="$page.props.faClass" />
                </button>
                <MenuButton class="btn">
                    <span class="sr-only">Switch between Dark & Light Mode</span>
                    <FontAwesomeIcon :icon="[$page.props.faIcon, 'fa-sun-bright']" :class="$page.props.faClass" v-if="this.theme == 'light'"/>
                    <FontAwesomeIcon :icon="[$page.props.faIcon, 'fa-moon']" :class="$page.props.faClass" v-else-if="this.theme == 'dark'"/>
                    <FontAwesomeIcon :icon="[$page.props.faIcon, 'fa-display']" :class="$page.props.faClass" v-else/>
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
                                    <FontAwesomeIcon :icon="[$page.props.faIcon, 'fa-sun-bright']" :class="$page.props.faClass"/>
                                    Light Mode
                                </button>
                            </MenuItem>
                            <MenuItem class="menu-item" :class="{ 'active': this.theme == 'dark' }">
                                <button @click="toggleTheme('dark')" type="button">
                                    <FontAwesomeIcon :icon="[$page.props.faIcon, 'fa-moon']" :class="$page.props.faClass"/>
                                    Dark Mode
                                </button>
                            </MenuItem>
                            <MenuItem class="menu-item" :class="{ 'active': !this.theme }">
                                <button @click="toggleTheme()" type="button">
                                    <FontAwesomeIcon :icon="[$page.props.faIcon, 'fa-display']" :class="$page.props.faClass"/>
                                    System
                                </button>
                            </MenuItem>
                    </MenuItems>
                </transition>
            </Menu>
        </div>
    </header>
    <main class="container o">
        <nav class="left-nav">
            <MainMenu />
        </nav>
        <div class="content">
            <slot/>
        </div>
    </main>
    <footer>
        <div class="container">
            <Footer />
        </div>
    </footer>
</template>

<script>
import MainMenu from './../Components/MainMenu.vue';
import Footer from './../Components/Footer.vue';
/* FontAwesome START */
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {library} from '@fortawesome/fontawesome-svg-core'
import {
    faDisplay,
    faSunBright,
    faMoon,
    faBars,
} from '@fortawesome/pro-solid-svg-icons'
library.add(
    faDisplay,
    faSunBright,
    faMoon,
    faBars,
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
} from '@headlessui/vue'
/* "Headless UI End */

export default {
    name: "Layout",
    components: {
        FontAwesomeIcon,
        MainMenu,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        Footer,
        TransitionRoot,
        TransitionChild,
    },
    data() {
        return {
            menuOpen: false,
            theme: null,
            stuffLinks: [
                {
                    url: '/nova-packages',
                    label: 'Nova Packages'
                },
                {
                    url: '/sites',
                    label: 'Websites'
                }
            ],
        }
    },
    props: {
        pageTitle: String,
    },
    methods: {
        toggleTheme(scheme) {
            console.log(scheme)
            scheme ? localStorage.theme = scheme : localStorage.removeItem('theme')
            this.applySystemColorTheme()
        },
        applySystemColorTheme() {
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
        this.applySystemColorTheme()
    },
    updated() {
        document.title = this.$page.props.pageTitle
    }
}
</script>
