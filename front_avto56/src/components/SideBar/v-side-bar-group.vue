<template>
    <div class="v-route__group">
        <p class="v-route__categories">{{ categories }}</p>
        <div class="v-route__row">
            <router-link
                @click="submit()"
                v-for="link in links"
                :key="link" 
                :to="link.route" 
                class="v-route__link"
                >
                <i :class="'fa fa-'+icon" aria-hidden="true"></i>
                <span>{{ link.name }}</span>
            </router-link>
        </div>
    </div>
</template>

<script lang="ts">
import {mapMutations } from 'vuex'

export default {
    props: {
        categories: String,
        links: Object,
        icon: String
    },

    methods: {
        ...mapMutations(['updateMenu']),
        submit() {
            this.updateMenu(false)
        }
    }
}
</script>

<style scoped>
.v-route__group {
    margin: 40px 0px;
}

.v-route__categories {
    color: rgb(190, 190, 190);
}
.v-route__row {
    display: grid;
    padding: 8px 0px;
}

.v-route__link {
    padding: 10px 20px;
    text-decoration: none;
    color: #000;
    font-size: 16px;
}

.v-route__link i {
    margin-right: 10px;
}

.v-route__link:hover {
    background: rgb(227, 227, 227);
}
</style>