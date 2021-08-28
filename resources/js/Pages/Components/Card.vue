<template>
    <div class="card" :class="cardClass">
        <div class="header">
            <h1>{{ title }}</h1>
        </div>
        <div class="body" :class="bodyClass">
            <slot></slot>
        </div>
        <div class="footer" v-if="$slots.footer">
            <slot name="footer"></slot>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: String,
        bodyClass: String,
        cardClass: String,
    },
    name: "Card",
    methods: {
        dd(item) {
            console.log(item);
        },
    }
}
</script>

<style scoped>

</style>
