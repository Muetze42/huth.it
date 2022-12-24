<template>
    <h1>Open Source</h1>
    <select class="form-select mb-4 desktop:mb-8" v-model="tag" @change="select">
        <option v-for="(tag, index) in tags" :value="index">{{ tag }}</option>
    </select>
    <div v-for="(repository, index) in packages.data">
        <hr v-if="index">
        <h2 class="h3">
            <a :href="'https://github.com/Muetze42/'+repository.name" target="_blank">{{repository.name}}</a>
        </h2>
        <div v-if="repository.description">
            {{ repository.description }}
        </div>
        <div class="mt-2 text-sm">
            Topics:<br>
            <span v-for="(topic, index) in repository.topics">
                <span v-if="index" class="mx-1">
                    &bull;
                </span>
                {{ topic }}
            </span>
        </div>
        <div class="mt-2 text-sm">
            Stars: {{ repository.stars }}
            <br>
            Watchers: {{ repository.watchers }}
            <br>
            Downloads: {{ repository.downloads }}
        </div>
        <template v-if="repository.novaPackageUrl">
            <div v-if="repository.ratingCount > 0" class="mt-2 text-sm">
                Rating:
                {{ repository.rating }}/5 with {{ repository.ratingCount }} {{ repository.ratingCount == 1 ? 'vote':'votes' }} on <a :href="repository.novaPackageUrl" target="_blank">NovaPackages.com</a>
            </div>
            <div v-else class="mt-2 text-sm">
                Unrated on <a :href="repository.novaPackageUrl" target="_blank">NovaPackages.com</a>
            </div>
        </template>
    </div>
    <Pagination :links="packages.links" class="mb-4" />
    This is only a selection. You can browse all repositories on <a href="https://github.com/Muetze42?tab=repositories" target="_blank"><font-awesome-icon :icon="'fa-brands fa-github'" class="fa-fw" />Github</a>.
</template>

<script>
import Pagination from './../../Components/Pagination.vue'

export default {
    components: {
        Pagination,
    },
    data() {
        return {
            'tag': this.currentTag
        }
    },
    props: {
        'packages': Object,
        'tags': Object,
        'currentTag': String,
    },
    methods: {
        select() {
            let data = {}

            if (this.tag != 0) {
                data = Object.assign(data, {
                    'tag': this.tag
                })
            }

            this.$inertia.get('/open-source', data, {
                preserveState: true,
                preserveScroll: false,
            });
        }
    }
}
</script>
