<template>
    <h1 class="hidden">Password Generator</h1>
    <div class="form-row mb-2">
        <label for="password" class="sr-only">
            Password
        </label>
        <div class="form-group">
            <input id="password" type="text" v-model="password">
            <button @click="generatePassword()" aria-label="Refresh">
                <font-awesome-icon :icon="['far', 'sync']" class="fa-fw"/>
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
</template>

<script>
export default {
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
    methods: {
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

<style scoped>

</style>
