<template>
    <header>
        <div class="w-content">
            <div>
                <Link href="/" class="site-title">Norman Huth</Link>
                <a href="https://stand-with-ukraine.pp.ua/" target="_blank" id="StandWithUkraine">
                    <img src="https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg" alt="StandWithUkraine">
                </a>
            </div>
            <div>
                <button @click="toggleT()" class="theme-switch">
                    <font-awesome-icon v-if="dark" :icon="['far', 'brightness']" class="fa-fw" title="Toggle to Light Mode" />
                    <font-awesome-icon v-else :icon="['far', 'moon']" class="fa-fw" title="Toggle to Dark Mode" />
                </button>
                <button class="menu-toggle" @click="toggleM()">
                    <font-awesome-icon v-if="open" :icon="['far', 'xmark']" class="fa-fw" title="Close Menu" />
                    <font-awesome-icon v-else :icon="['far', 'bars']" class="fa-fw" title="Open Menu" />
                </button>
            </div>
        </div>
    </header>
    <div class="overlay" v-if="open" @click="toggleM()"></div>
    <div class="content w-content">
        <div class="sidebar" :class="{ 'open': open}">
            <nav>
                <Link href="/" :class="{ 'active': $page.url.split('?')[0] === '/' }">Home</Link>
                <a :class="{ 'active': isStuff() }" @click="toggleS">
                    Stuff
                    <font-awesome-icon v-if="stuff" :icon="['far', 'caret-down']" class="fa-fw" title="Close Menu" />
                    <font-awesome-icon v-else :icon="['far', 'caret-right']" class="fa-fw" title="Open Menu" />
                </a>
                <template v-if="stuff">
                    <Link v-for="link in stuffLinks" :href="link" class="sub" :class="{ 'active': $page.url.split('?')[0] === link }">
                        <font-awesome-icon :icon="['far', 'ellipsis-vertical']" class="fa-fw" />
                        {{ link.substring(1).replace("-", " ").replace(/(^\w|\s\w)/g, m => m.toUpperCase()) }}
                    </Link>
                </template>
                <Link href="/password-generator" :class="{ 'active': $page.url.split('?')[0] === '/password-generator' }">Password Generator</Link>
                <Link href="/string-formatter" :class="{ 'active': $page.url.split('?')[0] === '/string-formatter' }">String Formatter</Link>
                <Link href="/imprint" :class="{ 'active': $page.url.split('?')[0] === '/imprint' }">Imprint</Link>
            </nav>
        </div>
        <main>
            <slot/>
        </main>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    name: "Layout",
    data() {
        return {
            dark: true,
            open: false,
            stuff: false,
            stuffLinks: ['/nova-packages'],
        }
    },
    remember: [
        'dark',
        'stuff',
    ],
    props: {
        pageTitle: String,
    },
    methods: {
        toggleM() {
            this.open = !this.open;
            this.setBodyClass()
        },
        toggleS() {
            this.stuff = !this.stuff;
        },
        toggleT() {
            this.dark = !this.dark;
            localStorage.setItem("lightMode", !this.dark ? 'true' : '');
            this.setBodyClass()
        },
        setBodyClass() {
            let body = document.body;
            this.dark ? body.classList.add("dark") : body.classList.remove("dark")
            body.style.overflow = this.open ? 'hidden' : 'visible'
        },
        isStuff() {
            return this.stuffLinks.includes(this.$page.url.split('?')[0])
        },
    },
    mounted() {
        if (this.isStuff()) {
            this.stuff = true;
        }
        this.dark = localStorage.getItem("lightMode") !== "true"
        this.setBodyClass()
        Inertia.on("navigate", (event) => {
            this.open = false
            this.setBodyClass()
        });
    },
    updated() {
        if (this.pageTitle) {
            document.title = this.pageTitle
        }
    },
}
</script>
