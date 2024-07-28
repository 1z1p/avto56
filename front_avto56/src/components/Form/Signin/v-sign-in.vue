<template>
    <form class="v-sing-in">
        <h2>Авторизация</h2>
        <h3 class="v-sign-in__error">{{ message }}</h3>
        <Input
            v-model="nameUser"
            type="text" 
            placeholder="Имя пользователя"/>
        <Input
            v-model="password"
            type="password" 
            placeholder="Пароль"/>
        <div class="v-inner">
            <Button
                @click.prevent="SignIN()" 
                text="Войти" />
            <!-- <vLinkVue 
                text="Регистрация"
                route="/signup" /> -->
        </div>
    </form>
</template>

<script>
import axios from 'axios'
import Button from '../../UI/Button/v-button.vue'
import Input from '../../UI/Input/v-input.vue'
import config from '@/config/config'
import router from '@/router'
import store from '@/store'
import vLinkVue from '@/components/UI/Link/v-link.vue'

export default {
    components: {
        Button,
        Input,
        vLinkVue,
    },

    data() {
        return {
            nameUser: "",
            password: "",
            message: ""
        }
    },

    methods: {
        SignIN() {
            if(this.nameUser == "" || this.password == "") {
                this.message = 'Заполните поля'
            } else {
                axios.post(`${config.api.url}/auth/login`,
                {
                    username: this.nameUser,
                    password: this.password,
                })
                .then((response) => {
                    localStorage.setItem('access_token', response.data.access_token)
                    store.commit('updateRole', response.data.role)
                    router.push('/table')
                })
                .catch((error) => {
                    if(error.response.status == 401)
                        this.message = "Имя пользователя или пароль неверный!"
                    else if(error.response.status == 500)
                        this.message = "500 пропало соединение с сервером!"
                })
            }
        }
  }
}
</script>

<style scoped>
.v-sing-in {
    display: flex;
    flex-direction: column;
    max-width: 300px;
    margin: 120px auto;
} 

h2 {
    margin-bottom: 20px;
}

.v-sign-in__error {
    color: lightcoral;
}

@media (max-width: 400px) {
    .v-sing-in {
        max-width: 250px;
    } 
}
</style>