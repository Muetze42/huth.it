<template>
    <form @input="isDisabled()" @submit.prevent="submit">
        <div class="form-row mb-2">
            <label for="string" class="sr-only">
                String
            </label>
            <input id="string" type="text" v-model="string">
        </div>
        <div class="radio">
            <input type="radio" id="camelCase" value="camelCase" v-model="stringMethod" name="stringMethod">
            <label for="camelCase">
                Converts the given string to camelCase <code>fooBar</code>
            </label>
        </div>
        <div class="radio">
            <input type="radio" id="kebab-case" value="kebab-case" v-model="stringMethod" name="stringMethod">
            <label for="kebab-case">
                Converts the given string to kebab-case <code>foo-bar</code>
            </label>
        </div>
        <div class="radio">
            <input type="radio" id="snake_case" value="snake_case" v-model="stringMethod" name="stringMethod">
            <label for="snake_case">
                Converts the given string to snake_case <code>foo_bar</code>
            </label>
        </div>
        <div class="radio">
            <input type="radio" id="StudlyCase" value="StudlyCase" v-model="stringMethod" name="stringMethod">
            <label for="StudlyCase">
                Converts the given string to StudlyCase <code>FooBar</code>
            </label>
        </div>
        <div class="radio">
            <input type="radio" id="ASCII" value="ASCII" v-model="stringMethod" name="stringMethod">
            <label for="ASCII">
                Transliterate the string into an ASCII value
            </label>
        </div>
        <div class="radio">
            <input type="radio" id="slug" value="slug" v-model="stringMethod" name="stringMethod">
            <label for="slug">
                Generates a „SEO friendly URL“ slug from the given string
            </label>
        </div>
        <div class="submit-row">
            <span class="ping-container">
                <select v-model="slugLang" v-if="this.stringMethod === 'slug' || this.stringMethod === 'ASCII'">
                    <option value="en">English</option>
                    <option value="de">German</option>
                    <option value="bg">Bulgarian</option>
                </select>
                <button type="submit" :disabled='disabled' class="btn">
                    {{ stringMethod }}
                </button>
                <span class="ping-1" v-if='sending'>
                    <span class="ping-2"></span>
                    <span class="ping-3"></span>
                </span>
            </span>
        </div>
        <div class="form-row mt-4">
            <label for="output" class="sr-only">
                Output
            </label>
            <input id="output" type="text" v-model="output" readonly @focus="$event.target.select()">
        </div>
    </form>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'

export default {
    props: {
        serverSideOutput: String,
    },
    data() {
        return {
            string: '',
           output: '',
            slugLang: 'en',
            disabled: true,
            sending: false,
            // output: this.output,
            stringMethod: "camelCase",
            params: {
                serverSideOutput: this.serverSideOutput
            },
        }
    },
    mounted() {
        Inertia.on("finish", (event) => {
            this.output = this.serverSideOutput
        });
    },
    methods: {
        submit: function () {
            this.sending = true
            this.disabled = true

            switch(this.stringMethod) {
                case 'camelCase':
                    this.output = this.camelize(this.string)
                    break;
                case 'kebab-case':
                    this.output = this.string.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                        .map(x => x.toLowerCase())
                        .join('-')
                    break;
                case 'snake_case':
                    this.output = this.string.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                        .map(x => x.toLowerCase())
                        .join('_');
                    break;
                default:
                    let data = {
                        string: this.string,
                        language: this.slugLang,
                        method: this.stringMethod,
                    }

                    Inertia.post('/string-formatter', data)
            }

            this.sending = false
            this.disabled = false
        },
        isDisabled: function() {
            if (this.sending) {
                return this.disabled = true
            }

            this.output = ''
            return this.disabled = !this.string
        },
        sentenceCase (str) {
            if ((str===null) || (str===''))
                return false;
            else
                str = str.toString();

            return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
        },
        camelize(string) {
            string = string.replace(/[-_\s.]+(.)?/g, (_, c) => c ? c.toUpperCase() : '');
            return string.substr(0, 1).toLowerCase() + string.substr(1);
        }
    },
}
</script>

<style scoped>

</style>
