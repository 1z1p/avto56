<template>
    <div 
        class="v-mobile__btn"
        v-if="Menu == vIF"
        @click.prevent="submit(paramsSubmit)">
        {{ icon }}
    </div>
</template>

<script lang="ts">
import { mapGetters, mapMutations } from 'vuex'
export default {
    props: {
        vIF: Boolean,
        paramsSubmit: Boolean,
        icon: String
    },

    computed: mapGetters(['Menu']),
    methods: {
        ...mapMutations(["updateMenu"]),
        submit(params: boolean) {
            this.updateMenu(params)
        }
    }
}
</script>

<style scoped>
.v-mobile__btn {
    display: none;
}

@media (max-width: 1100px) {
    .v-mobile__btn {
        display: block;
        position: absolute;
        left: 20px;
        top: 30px;
    }
}
</style>