<template>
    <a v-for="link in links" target="_blank" class="btn" :href="link.url">
        <font-awesome-icon :icon="'fa-brands fa-'+ link.icon" :class="$page.props.faClass" />
        {{ link.label }}
    </a>
</template>

<script>
/* FontAwesome START */
import {library} from '@fortawesome/fontawesome-svg-core'
import {
    faLinkedin,
    faInstagram,
    faLaravel,
} from '@fortawesome/free-brands-svg-icons'
library.add(
    faLinkedin,
    faInstagram,
    faLaravel,
);
/* FontAwesome END */
export default {
    name: "Footer",
    data() {
        return {
            links: [
                {
                    icon: 'github',
                    label: 'GitHub',
                    url: 'https://github.com/Muetze42',
                },
                {
                    icon: 'linkedin',
                    label: 'LinkedIn',
                    url: 'https://www.linkedin.com/in/normanhuth/',
                },
                {
                    icon: 'instagram',
                    label: 'Instagram',
                    url: 'https://www.instagram.com/muetze_official',
                },
                {
                    icon: 'laravel',
                    label: 'Laracasts',
                    url: 'https://laracasts.com/@Muetze',
                },
            ]
        }
    },
}
</script>
