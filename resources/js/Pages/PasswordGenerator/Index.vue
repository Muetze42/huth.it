<template>
    <card :title="'Password Generator'" :cardClass="'w-120'" :bodyClass="'form-body'">
        <form v-on:submit.prevent>
            <div class="form-row">
                <label for="password" class="hidden">
                    Password
                </label>
                <div class="form-group">
                    <input id="password" type="text" v-model="password" @input="hideHash()">
                    <button @click="generatePassword()">
                        <i class="fas fa-sync-alt fa-fw"></i>
                    </button>
                </div>
            </div>
            <div class="form-list">
                <label>
                    <input type="checkbox" v-model="charsSmall" @input="generatePassword()">
                    Using „a-z“ character set
                </label>
                <label>
                    <input type="checkbox" v-model="charsBig" @input="generatePassword()">
                    Using „A-Z“ character set
                </label>
                <label>
                    <input type="checkbox" v-model="numbers" @input="generatePassword()">
                    Using „0-9“ number set
                </label>
            </div>
            <div class="form-row">
                <label for="specialChars">
                    Special Characters
                </label>
                <input type="text" id="specialChars" v-model="specialChars" @input="generatePassword()">
            </div>
            <div class="form-row">
                <label for="passLength">
                    Password Length
                </label>
                <input type="number" id="passLength" v-model="passLength" min="1" step="1" @input="generatePassword()">
            </div>
        </form>
        <template v-slot:footer>
            <form @submit.prevent="generateHash">
                <div class="submit-row">
                    <span class="ping-container">
                        <button type="submit" :disabled='disabled'>
                            Create WordPress & Joomla Hash
                        </button>
                        <span class="ping-1" v-if='sending'>
                            <span class="ping-2"></span>
                            <span class="ping-3"></span>
                        </span>
                    </span>
                </div>
            </form>
            <div v-if="Object.keys(passHash).length || passHash.length" class="form-body">
                <div class="form-row mt-4">
                    <label for="wordpress">
                        WordPress
                    </label>
                    <input id="wordpress" type="text" readonly :value="passHash.wordpress" @focus="$event.target.select()">
                </div>
                <div class="form-row">
                    <label for="joomla">
                        Joomla
                    </label>
                    <input id="joomla" type="text" readonly :value="passHash.joomla" @focus="$event.target.select()">
                </div>
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
    data() {
        return {
            charsSmall: true,
            charsBig: true,
            numbers: true,
            password: '',
            passLength: 16,
            sending: false,
            specialChars: '!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~',
            passHash: {},
            disabled: false,
        }
    },
    components: {
        Card
    },
    methods: {
        generateHash: _.debounce(function () {
            this.sending = true
            this.disabled = true
            console.log(this.passHash)

            axios.post(route("password-generator.store"), {
                _token: this._token,
                password: this.password,
            }) .then(response => {
                this.passHash = response.data
                this.sending = false
                this.disabled = false
            }).catch((error) => {
                if (window.confirm("An unknown error has occurred. Please try again at another time")) {
                    this.sending = false
                }
            })
        }, 10),
        hideHash() {
            this.passHash = {}
        },
        generatePassword() {
            let characters = ''
            this.hideHash()

            if (this.charsSmall) {
                characters += 'abcdefghijklmnopqrstuvwxyz'
            }
            if (this.charsBig) {
                characters += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            }
            if (this.numbers) {
                characters += '0123456789'
            }

            characters += this.specialChars

            this.disabled = !characters.length || this.passLength<1;

            let newPassword = '';
            for(let i=0; i < this.passLength; i++) {
                newPassword += characters.charAt(Math.floor(Math.random() * characters.length));
            }

            this.password = newPassword;
        },
    },
    mounted: function(){
        this.generatePassword()
    }
}
</script>
