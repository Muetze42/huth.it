<template>
    <card :title="'Password Generator'" :cardClass="'w-120'" :bodyClass="'form-body'">
        <form @input="generatePassword()" v-on:submit.prevent>
            <div class="form-row">
                <label for="password" class="hidden">
                    Password
                </label>
                <div class="form-group">
                    <input id="password" type="text" v-model="password">
                    <button @click="generatePassword()">
                        <i class="fas fa-sync-alt fa-fw"></i>
                    </button>
                </div>
            </div>
            <div class="form-check">
                <label>
                    <input type="checkbox" v-model="charsSmall">
                    Using „a-z“ character set
                </label>
            </div>
            <div class="form-check">
                <label>
                    <input type="checkbox" v-model="charsBig">
                    Using „A-Z“ character set
                </label>
            </div>
            <div class="form-check mb-3">
                <label>
                    <input type="checkbox" v-model="numbers">
                    Using „0-9“ number set
                </label>
            </div>
            <div class="form-row">
                <label for="specialChars">
                    Special Characters
                </label>
                <input type="text" id="specialChars" v-model="specialChars">
            </div>
            <div class="form-row">
                <label for="passLength">
                    Password Length
                </label>
                <input type="number" id="passLength" v-model="passLength" min="1" step="1">
            </div>
        </form>
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
            specialChars: '!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~'
        }
    },
    components: {
        Card
    },
    methods: {
        generatePassword() {
            console.log(this.chars)
            let characters = ''

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

            let newPassword = '';
            for(let i=0; i < this.passLength; i++) {
                newPassword += characters.charAt(Math.floor(Math.random() * characters.length));
            }

            this.password = newPassword;
        },
        count(id) {
            axios.post('/link/'+id, {
                _token: this.$page.props.csrf_token,
            });
        }
    },
    mounted: function(){
        this.generatePassword()
    }
}
</script>
