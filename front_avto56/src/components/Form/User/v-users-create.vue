<template>
    <form 
        v-bind:class='{"v-users-create__form": true, "v-users-create__load": load}'>
        <vLoaderVue 
            v-if="load"
        />
        <h3 class="v-users-create__error">{{ msg }}</h3>
        <vInputVue 
            type="text" 
            placeholder="ФИО"
            v-model="name" />
        <vInputVue 
            type="text" 
            placeholder="Имя пользователя"
            v-model="username" />
        <vInputVue 
            type="text" 
            placeholder="Пароль"
            v-model="password" />
        <vSelectVue 
            v-model="incpector"
            placeholder="Выберите инструктора"
            :options="data"
        />
        <vButtonVue
            @click.prevent="CreateUser()" 
            text="Создать"
        />
    </form>
</template>

<script>
import API from '@/api/api'
import config from '@/config/config'
import router from '@/router'
import vButtonVue from '@/components/UI/Button/v-button.vue'
import vInputVue from '@/components/UI/Input/v-input.vue'
import vSelectVue from '@/components/UI/Select/v-select.vue'
import vLoaderVue from '@/components/Loader/v-loader.vue'

export default {
    components: {
        vButtonVue,
        vInputVue,
        vSelectVue,
        vLoaderVue
    },

    data() {
        return {
            name: "",
            username: "",
            password: "",
            incpector: "",
            load: true,
            data: [],
            msg: ""
        }
    },

    mounted() {
        this.Incpector()
    },

    methods: {
        async Incpector() {
            await API.post(`${config.api.url}/auth/users/incpector`)
            .then(response => {
                this.data = response.data
                this.load = false
            })
        },

        CreateUser() {
            API.post(`${config.api.url}/auth/users/create`, {
                name: this.name,
                username: this.username,
                password: this.password,
                incpector: this.incpector,
                role: "cabet"
            })
            .then(response => {
                alert('Аккаунт создан')
                router.push('/user/cabet/all')
            })
            .catch((error) => {
                this.msg = '500 ошибка сервера'
            })
        }
    }
}

</script>

<style scoped>
.v-users-create__form {
    display: flex;
    flex-direction: column;
    max-block-size: 600px;
    margin: 0 auto;
    position: relative;
}

.v-users-create__load {
    opacity: 0.5;
}

.v-users-create__error {
    color: lightcoral;
}
</style>