<template>
    <div class="v-404">
        <div class="v-container">
            <router-link class="v-404__link" to="/"> 
                <vButtonVue 
                    text="Назад" />
            </router-link>
            <h2 class="v-404__name">404 Страница не найдена</h2>
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

.v-404{
    margin-left: 10px;
}
.v-404__name {
    text-align: center;
    color: lightcoral;
}
</style>