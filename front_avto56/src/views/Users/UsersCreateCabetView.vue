<template>
    <div class="v-create-cabet">
        <div class="v-container">
            <div class="v-inner-top">
                <vSideBarVue />
                <div class="v-create-cabet__data">
                    <h2>Создание аккаунта курсанта</h2>
                    <vUsersCreateVue />
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import vSideBarVue from '@/components/SideBar/v-side-bar.vue'
import vUsersCreateVue from '@/components/Form/User/v-users-create.vue'
export default {
    components: {
        vSideBarVue,
        vUsersCreateVue
    }
}
</script>

<style scoped>
.v-create-cabet__data {
    width: 980px;
    margin: 20px;
}
</style>