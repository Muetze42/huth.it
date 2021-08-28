<template>
    <form @input="isDisabled()" @submit.prevent="submit">
        <card :title="'Contact'" :bodyClass="'form-body'" :cardClass="'w-120'">
            <div v-if="sent" class="contact-success">
                <p>Thank you for your message.</p>
                <p>It will be processed as soon as possible.</p>
                <i class="far fa-envelope fa-5x"></i>
            </div>
            <template v-if="!sent">
                <div class="form-row">
                    <label for="name">
                        Name
                    </label>
                    <input id="name" type="text" placeholder="Name" v-model="name" maxlength="50" required>
                </div>
                <div class="form-row">
                    <label for="subject">
                        Subject
                    </label>
                    <input id="subject" type="text" placeholder="Subject" v-model="subject" maxlength="50" required>
                </div>
                <div class="form-row">
                    <label for="message">
                        Message <span class="help">(Accepted: English & German)</span>
                    </label>
                    <textarea id="message" v-model="message" placeholder="Message in English or German" required></textarea>
                </div>
                <div class="form-row">
                    <label for="email">
                        Email Address
                    </label>
                    <input id="email" type="email" placeholder="Email Address" autocomplete="email" v-model="email" @keyup="mailConfirmed()" required>
                </div>
                <div class="form-row">
                    <label for="confirm">
                        Confirm Email Address
                    </label>
                    <input id="confirm" type="text" placeholder="Confirm Email Address" v-model="confirm" @keyup="mailConfirmed()" required>
                    <p v-if="!confirmed">The Email addresses entered do not match.</p>
                </div>
            </template>
            <template v-slot:footer v-if="!sent">
                <div class="confirmations">
                    <label for="confirmation">Confirm privacy policy</label>
                    <input id="confirmation" type="checkbox" v-model="confirmation">
                </div>
                <div class="submit-row">
                    <span class="ping-container">
                        <button type="submit" :disabled='disabled'>
                            Send Message
                        </button>
                        <span class="ping-1" v-if='sending'>
                            <span class="ping-2"></span>
                            <span class="ping-3"></span>
                        </span>
                    </span>
                </div>
            </template>
        </card>
    </form>
</template>

<script>
import Default from '../Layout/Default'
import Card from '../Components/Card'

export default {
    layout: Default,
    name: "Index",
    props: {
        links: Object,
        subject: String,
        name: String,
        message: String,
        email: String,
        confirm: String,
        confirmation: Boolean,
    },
    components: {
        Card
    },
    data: () => ({
        confirmed: true,
        sending: false,
        disabled: true,
        sent: false,
    }),
    methods: {
        submit: _.debounce(function () {
            this.sending = true
            this.disabled = true

            axios.post(route("contact.store"), {
                _token: this._token,
                subject: this.subject,
                name: this.name,
                message: this.message,
                email: this.email,
                confirm: this.confirm,
            }) .then(response => {
                this.sent = true
            }).catch((error) => {
                if (error.response && error.response.status === 421) {
                    if (window.confirm(error.response.data)) {
                        this.sending = false
                    }
                } else {
                    if (window.confirm("An unknown error has occurred. Please try again at another time")) {
                        this.sending = false
                    }
                }
            })
        }, 10),
        isDisabled: function() {
            this.mailConfirmed()
            if (this.sending) {
                return this.disabled = true
            }
            if (this.subject && this.message && this.email && this.confirm && this.confirmed) {
                return this.disabled = false
            }
            return this.disabled = true
        },
        mailConfirmed: function() {
            let email = this.email
            let confirm = this.confirm

            if (!confirm || !email) {
                return this.confirmed = true
            }

            let checkEmail = email.trim()
            let checkConfirm = confirm.trim()

            if (checkEmail === checkConfirm) {
                return this.confirmed = true
            }

            return this.confirmed = false
        },
    },
}
</script>
