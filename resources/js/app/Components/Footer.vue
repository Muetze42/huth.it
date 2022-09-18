<template>
    <a v-for="link in links" target="_blank" class="btn" :href="link.url">
        <FontAwesomeIcon :icon="['fab', link.icon]" :class="$page.props.faClass"/>
        {{ link.label }}
    </a>
</template>

<script>
/* FontAwesome START */
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {library} from '@fortawesome/fontawesome-svg-core'
import {
    faGithub,
    faLinkedin,
    faLaravel,
    faInstagram,
} from '@fortawesome/free-brands-svg-icons'
library.add(
    faGithub,
    faLinkedin,
    faLaravel,
    faInstagram,
);
/* FontAwesome END */
export default {
    name: "Footer",
    components: {
        FontAwesomeIcon,
    },
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
