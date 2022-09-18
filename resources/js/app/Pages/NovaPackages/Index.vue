<template>
    <h1>Nova Packages</h1>
    <div class="danger">
        This page is under reconstruction.
    </div>
    <div v-for="(repository, index) in repositories.data">
        <hr v-if="index">
        <h2 class="h3">
            <a :href="'https://github.com/Muetze42/'+repository.name">{{repository.name}}</a>
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
        <div v-if="repository.ratingCount > 0" class="mt-2 text-sm">
            Rating:
            {{ repository.rating }}/5 with {{ repository.ratingCount }} {{ repository.ratingCount == 1 ? 'vote':'votes' }} on <a :href="repository.homepage" target="_blank">NovaPackages.com</a>
        </div>
        <div v-if="repository.homepage && repository.ratingCount < 1" class="mt-2 text-sm">
            Unrated on <a :href="repository.homepage" target="_blank">NovaPackages.com</a>
        </div>
    </div>
</template>

<script>
import Pagination from './../../Components/Pagination.vue'
export default {
    components: {
        Pagination,
    },
    props: {
        'repositories': Object,
    },
}
</script>
