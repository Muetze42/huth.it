<template>
    <card :title="'Norman Huth'" :cardClass="'w-80'">
        <img src="/img/Norman-Huth-100.jpg" alt="Norman Huth" class="avatar">
        <h2 class="text-center">
            Computer Science Expert
        </h2>
        <h3 class="text-center">
            Subject Area:<br>Software Development
        </h3>
        <template v-slot:footer>
            <div class="group">
                <template v-for="link in links">
                    <a :href="link.target" target="_blank" class="btn" :class="'btn-'+link.id" rel="noopener" @click="count(link.id)">
                        <i class="fw-fw" :class="link.icon"></i>
                        <span class="sr-only">{{ link.name }}</span>
                    </a>
                </template>
            </div>
        </template>
    </card>
</template>

<script>
import Default from '../Layout/Default'
import Card from '../Components/Card'

export default {
    layout: Default,
    name: "Index",
    props: {
        links: Object,
    },
    components: {
        Card
    },
    methods: {
        count(id) {
            axios.post('/link/'+id, {
                _token: this.$page.props.csrf_token,
            });
        }
    },
}
</script>
