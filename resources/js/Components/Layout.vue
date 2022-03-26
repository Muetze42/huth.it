<template>
    <header>
        <div class="w-content">
            <Link href="/" class="site-title">Norman Huth</Link>
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
                <Link href="/password-generator" :class="{ 'active': $page.url.split('?')[0] === '/password-generator' }">Password Generator</Link>
                <Link href="/string-formatter" :class="{ 'active': $page.url.split('?')[0] === '/string-formatter' }">String Formatter</Link>
                <!-- Link href="/references" :class="{ 'active': $page.url.split('?')[0] === '/references' }">References</Link -->
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
        }
    },
    remember: 'dark',
    props: {
        pageTitle: String,
    },
    methods: {
        toggleM() {
            this.open = !this.open;
            this.setBodyClass()
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
    },
    mounted() {
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
