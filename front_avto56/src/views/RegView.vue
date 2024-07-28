<template>
    <form class="v-sing-up">
        <h2>Регистрация</h2>
        <h3 class="v-sign-up__error">{{ message }}</h3>
        <Input
            v-model="nameFullName"
            type="text" 
            placeholder="ФИО"/>
        <Input
            v-model="nameUser"
            type="text" 
            placeholder="Придумайте: Имя пользователя"/>
        <Input
            v-model="password"
            type="password" 
            placeholder="Придумайте: Пароль"/>
        <vSelectVue 
            v-model="incpector"
            :options="data"
            placeholder="Выберите инструктора" />
        <Input
            v-model="code"
            type="text" 
            placeholder="Код"/>
        <div class="v-inner">
            <Button
                @click.prevent="SignUP()" 
                text="Далее" />
            <vLinkVue
                text="Назад"
                route="/" />
        </div>
    </form>
</template>

<script>
import axios from 'axios'
import config from '@/config/config'
import router from '@/router'
import store from '@/store'
import vLinkVue from '@/components/UI/Link/v-link.vue'
import Button from '@/components/UI/Button/v-button.vue'
import Input from '@/components/UI/Input/v-input.vue'
import vSelectVue from '@/components/UI/Select/v-select.vue'

export default {
    components: {
        Button,
        Input,
        vLinkVue,
        vSelectVue
    },

    data() {
        return {
            nameFullName: "",
            nameUser: "",
            password: "",
            incpector: "",
            code: "",
            message: "",

            data: []
        }
    },

    mounted() {
        this.Incpector()
    },

    methods: {
        async Incpector() {
            axios.post(`${config.api.url}/auth/incpector`)
            .then(response => {
                this.data = response.data
            })
        },

        SignUP() {
            if(this.nameFullName == "" || this.nameUser == "" || this.password == "" || this.incpector == "" ||  this.code == "") {
                this.message = "Заполните поля"
            } else {
                axios.post(`${config.api.url}/auth/reg`,
            {
                fullname: this.nameFullName,
                username: this.nameUser,
                password: this.password,
                code: this.code,
                incpector: this.incpector
            })
            .then((response) => {
                console.log(response)
                router.push('/')
            })
            .catch((error) => {
                    console.log(error);
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
.v-sing-up {
    display: flex;
    flex-direction: column;
    max-width: 300px;
    margin: 120px auto;
} 

h2 {
    margin-bottom: 20px;
}

.v-sign-up__error {
    color: lightcoral;
}

@media (max-width: 400px) {
    .v-sing-up {
        max-width: 250px;
    } 
}
</style>