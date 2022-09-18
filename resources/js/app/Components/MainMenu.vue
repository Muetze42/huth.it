<template>
    <ul role="list" class="nav">
        <li v-for="menu in menus">
            <div v-if="menu.label" class="label">{{ menu.label }}</div>
            <ul role="list" class="items">
                <li v-for="item in menu.items">
                    <Link :href="item.url" :class="{ 'active': $page.url.split('?')[0] === item.url }">
                        {{ item.label }}
                    </Link>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
import menuData from './../../../../settings/menu.json';

export default {
    name: "MainMenu",
    data() {
        return {
            menus: menuData
        }
    },
}
</script>
