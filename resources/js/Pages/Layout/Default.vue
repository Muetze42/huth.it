<template>
    <div id="sidebar" :class="{ 'z-40': open}">
        <div id="sidebar-draw">
            <button
                @click.prevent="toggle()"
                id="sidebar-button"
                class="transition-color"
            >
                <span v-if="open">
                    <i class="fas fa-times menu-switch"></i>
                </span>
                <span v-else>
                    <i class="fas fa-bars menu-switch"></i>
                </span>
                <span class="sr-only">Menü</span>
            </button>

            <div id="sidebar-content" :class="[open ? 'max-w-lg border-r border-gray-500' : 'max-w-0']">
                <nav role="navigation">
                    <ul>
                        <li v-for="(item, index) in this.menuItems" :key="index">
                            <inertia-link v-if="route().current(item.route)" :href="route(item.route)" aria-current="page">{{ item.text }}</inertia-link>
                            <inertia-link v-else :href="route(item.route)">{{ item.text }}</inertia-link>
                        </li>
                    </ul>
                </nav>
                <nav>
                    <ul id="bottom">
                        <li v-if="this.authed">
                            <a href="/settings">
                                Administration
                            </a>
                        </li>
                        <li v-else>
                            <a :href="route('auth', 'github')">
                                <i class="fab fa-github fa-fw"></i>
                                Login with GitHub
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <transition name="fade">
            <div
                v-if="dimmer && open"
                @click="toggle()"
                id="sidebar-fade"
                class="active:outline-none"
            />
        </transition>
    </div>
    <main>
        <slot />
    </main>
    <div id="github-edit" v-if="gitController || gitComponent">
        <i class="fa-fw fab fa-github"></i> Edit [ <a v-if="gitComponent" :href="gitComponent" target="_blank">Component</a> <template v-if="gitController && gitComponent"> | </template> <a v-if="gitController" :href="gitController" target="_blank">Controller</a> ]
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    props: {
        metaTitle: String,
        gitController: String,
        gitComponent: String,
    },
    data() {
        return {
            open: false,
            dimmer: true,
        };
    },
    methods: {
        toggle() {
            this.open = !this.open;
        }
    },
    updated() {
        document.title = this.metaTitle
    },
    mounted() {
        Inertia.on("navigate", (event) => {
            this.toggle()
        });
    }
};
</script>
