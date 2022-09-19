<template>
    <h1>Password Generator</h1>
    <div class="form-row">
        <input id="password" type="text" v-model="password" class="form-input" aria-label="Password">
        <button @click="generatePassword()" aria-label="Refresh" class="btn">
            <font-awesome-icon icon="fa-sharp fa-solid fa-arrows-rotate" :class="$page.props.faClass" />
            Regenerate Passwort
        </button>
    </div>
    <div class="form-row">
        <label>
            <input type="checkbox" v-model="charsSmall" @input="generatePassword()" class="form-checkbox">
            Using „a-z“ character set
        </label>
    </div>
    <div class="form-row">
        <label>
            <input type="checkbox" v-model="charsBig" @input="generatePassword()" class="form-checkbox">
            Using „A-Z“ character set
        </label>
    </div>
    <div class="form-row">
        <label>
            <input type="checkbox" v-model="numbers" @input="generatePassword()" class="form-checkbox">
            Using „0-9“ number set
        </label>
    </div>
    <div class="form-row">
        <label for="specialChars">
            Special Characters
        </label>
        <input type="text" id="specialChars" v-model="specialChars" @input="generatePassword()" class="form-input">
    </div>
    <div class="form-row">
        <label for="passLength">
            Password Length
        </label>
        <input type="number" id="passLength" v-model="passLength" min="1" step="1" @input="generatePassword()" class="form-input">
    </div>
</template>

<script>
/* FontAwesome START */
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {library} from '@fortawesome/fontawesome-svg-core'
import {
    faArrowsRotate,
} from '@fortawesome/sharp-solid-svg-icons'
library.add(
    faArrowsRotate,
);
/* FontAwesome END */

export default {
    components: {
        FontAwesomeIcon,
    },
    data() {
        return {
            charsSmall: true,
            charsBig: true,
            numbers: true,
            password: '',
            passLength: 24,
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
