<template>
    <div class="danger">
        This page is under reconstruction.
    </div>
    <h1 class="hidden">Nova Packages</h1>
    <div v-for="(repository, index) in repositories.data">
        <hr v-if="index">
        <h2 class="h3">{{ repository.name }}</h2>
        <div v-if="repository.description">
            {{ repository.description }}
        </div>
        <div>
            Topics:
            <span v-for="(topic, index) in repository.topics">
                <span v-if="index" class="mx-1">
                    &bull;
                </span>
                {{ topic }}
            </span>
        </div>
        <div>
            Stars: {{ repository.stars }}
            Watchers: {{ repository.watchers }}
        </div>
        <div v-if="repository.ratingCount">
            Rating: {{ repository.rating }}/5<br>
            {{ repository.ratingCount }} {{ repository.ratingCount == 1 ? 'Rate':'Rates' }}
        </div>
        <a :href="'https://github.com/Muetze42/'+repository.name">GitHub</a>
        <div v-if="repository.homepage">
            <a :href="repository.homepage" target="_blank">NovaPackages.com</a>
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
