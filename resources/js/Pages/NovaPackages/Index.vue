<template>
    <h1 class="hidden">Nova Packages</h1>
    <div v-for="git in packages.data" class="git">
        <div class="lg:flex">
            <div class="flex-grow">
                <div class="title">
                    {{ git.name.replaceAll("-", " ").replaceAll(/(^\w|\s\w)/g, m => m.toUpperCase()) }}
                </div>
                <div class="p-2">
                    {{ git.description }}
                </div>
                <div class="tags flex-grow self-end p-2">
                    <span v-for="tag in git.tags" :class="{ 'danger' : tag === 'nova-3' }">
                        {{ tag }}
                    </span>
                    <span v-if="!git.released_at" class="danger">
                        Prerelease
                    </span>
                </div>
            </div>
            <div class="-whitespace-nowrap">
                <div class="box">
                    <template v-if="git.released_at">
                        <div class="item">
                            <span>
                                Version:
                            </span>
                            {{ git.version }}
                        </div>
                        <div class="item">
                            <span class="whitespace-nowrap">
                                Released at:
                            </span>
                            <span class="text-right">
                                {{ git.released_at }}
                            </span>
                        </div>
                    </template>
                    <a :href="'https://github.com/'+ git.github" target="_blank" class="border-b">
                        <font-awesome-icon :icon="['fab', 'github']" class="fa-fw"/>
                        GitHub
                    </a>
<!--                    <div class="item">-->
<!--                        <span class="whitespace-nowrap">-->
<!--                            Pushed at:-->
<!--                        </span>-->
<!--                        <span class="text-right">-->
<!--                            {{ git.pushed_at }}-->
<!--                        </span>-->
<!--                    </div>-->
                    <div class="item">
                        <span>
                            Stars:
                        </span>
                        {{ git.stars }}
                    </div>
                    <div class="item">
                        <span>
                            Forks:
                        </span>
                        {{ git.forks }}
                    </div>
                    <template v-if="git.parent">
                        <div class="text-center">
                            Forked from
                        </div>
                        <a :href="git.parent" target="_blank">
                            {{ this.getPath(git.parent) }}
                        </a>
                    </template>
                    <a :href="'https://packagist.org/packages/'+ git.packagist" target="_blank" class="border-b">
                        <font-awesome-icon :icon="['far', 'elephant']" class="fa-fw"/>
                        Composer
                    </a>
                    <div class="item">
                        <span>
                            Downloads:
                        </span>
                        {{ git.downloads }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Pagination :links="packages.links" />
</template>

<script>
import Pagination from './../../Components/Pagination';

export default {
    props: {
        packages: Object
    },
    mounted() {
        console.log(this.packages.data)
    },
    methods: {
        getPath(url) {
            let pathname = new URL(url).pathname;

            return pathname.substring(1);
        }
    },
    components: {
        Pagination
    },
}
</script>
