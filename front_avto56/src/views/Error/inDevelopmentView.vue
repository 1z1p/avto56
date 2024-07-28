<template>
    <div class="v-inDevelopment">
        <div class="v-container">
            <router-link to="/" class="v-inDevelopment__link"> 
                <vButtonVue 
                    text="Назад" />
            </router-link>
            <h2 class="v-inDevelopment__name">В разработке</h2>
        </div>
    </div>
</template>

<script>
import vButtonVue from '@/components/UI/Button/v-button.vue'

export default {
    components: {
        vButtonVue
    }
}
</script>

<style scoped>
.v-inDevelopment {
    margin-left: 10px;
}
.v-inDevelopment__name {
    text-align: center;
    margin-top: 10px;
}
</style>