<template>
    <div class="privacy">
        <button type="button" class="btn" lang="en" :class="{ 'active': lang == 'en' }" @click="lang = 'en'">English</button>
        <button type="button" class="btn" lang="de" :class="{ 'active': lang == 'de' }" @click="lang = 'de'">Deutsch</button>
    </div>
    <div lang="en" v-html="en" v-if="lang == 'en'" class="privacy-text" />
    <div lang="de" v-html="de" v-else class="privacy-text" />
</template>

<script>
export default {
    props: {
        de: String,
        en: String,
    },
    data() {
        return {
            lang: 'en',
        }
    },
}
</script>
