<template>
    <h1>Imprint</h1>
    <address>
        <div>{{ address.name }}</div>
        <div>{{ address.street }}</div>
        <div>{{ address.city }}</div>
        <div>{{ address.country }}</div>
        <div>VAT ID: {{ address.vat }}</div>
    </address>
    <h2>Contact</h2>
    {{ address.mAddress }}<FontAwesomeIcon :icon="['far', 'fa-at']"/>{{ address.mProvider }}
</template>

<script>
import addressData from './../../../../../settings/imprint.json'
/* FontAwesome START */
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {library} from '@fortawesome/fontawesome-svg-core'
import {
    faAt,
} from '@fortawesome/pro-regular-svg-icons'
// } from '@fortawesome/pro-light-svg-icons'
library.add(
    faAt,
);
/* FontAwesome END */
export default {
    components: {
        FontAwesomeIcon
    },
    data() {
        return {
            address: addressData
        }
    },
}
</script>
