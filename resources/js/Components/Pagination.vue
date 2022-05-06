<template>
    <div class="pagination" v-if="links.length > 3">
        <template v-for="link in links">
            <Component v-if="link.url || link.label === '...'"
                :is="link.url && !link.active ? 'Link' : 'span'"
                :href="link.url"
                v-html="link.label"
                :class="{ 'disabled': !link.url, 'current' : link.active }"
            />
        </template>
    </div>
</template>

<script>
export default {
    props: {
        links: Array
    },
};
</script>
