<template>
    <div class="v-side">
        <div class="v-route">
            <VSideBarGroup
                icon="home"  
                :links="[{'name': 'Профиль', 'route': '/profile'}]"
            />
            <VSideBarGroup
                v-if="Role == 'cabet' || Role == 'incpector'"
                icon="calendar" 
                categories="Теория"
                :links="[
                    {'name': 'Раписание', 'route': '/table'}, 
                    {'name': 'Записаться на занятие', 'route': '/table/create'},
                    {'name': 'Видео Уроки', 'route': '/video/lesson'},
                ]"
            />
            <VSideBarGroup
                v-if="Role == 'cabet'"
                icon="id-card" 
                categories="Практика"
                :links="[{'name': 'Инструкторы', 'route': '/incpector/all'}]"
            />
            <VSideBarGroup
                v-if="Role == 'cabet'"
                icon="credit-card" 
                categories="Финансы"
                :links="[{'name': 'Оплатить обучение', 'route': '/pay'}]"
            />
            <!-- admin -->
            <VSideBarGroup
                v-if="Role == 'admin'"
                icon="user" 
                categories="Расписание"
                :links="[
                    {'name': 'Расписание', 'route': '/schedule/incpectors'},
                ]"
            />
            <!-- <VSideBarGroup
                v-if="Role == 'admin'"
                icon="user" 
                categories="Учетные записи"
                :links="[
                    {'name': 'Список курсантов', 'route': '/user/cabet/all'},
                    {'name': 'Добавить курсанта', 'route': '/user/create/cabet'},
                    {'name': 'Добавить инструктора', 'route': '/development'}
                ]"
            /> -->
            <p class="v-side__version">ver: 1.0.0</p>
            <vButtonVue 
                @click.prevent="logout()"
                text="Выйти"
            />
        </div>
    </div>
</template>

<script lang="ts">
import API from '@/api/api';
import vButtonVue from '../UI/Button/v-button.vue';
import VSideBarGroup from './v-side-bar-group.vue';
import router from '@/router';
import config from '@/config/config';
import { mapGetters } from 'vuex';

export default {
    components: {
        VSideBarGroup,
        vButtonVue
    },

    computed: mapGetters(['Role']),

    methods: {
        logout() {
            API.post(`${config.api.url}/auth/logout`)
            .then(response => {
                localStorage.removeItem('access_token')
                localStorage.removeItem('role')
                router.push('/')
                
            })
        }
    }
}
</script>

<style scoped>
.v-side {
    width: 270px;
    height: 138vh;
    border-right: 2px solid #7a7a7a;
}

.v-route {
    margin-left: 10px;
}

h3 {
    padding: 20px;
}

.v-side__line {
    background: #9b9b9b;
    width: 100%;
    height: 5px;
}

.v-route__row {
    display: grid;
    padding: 8px 0px;
}

.v-side__version {
    opacity: 0.6;
    margin: 10px 0px;
}

@media (max-width: 1100px) {
    .v-side {
        position: fixed;
        background: #fff;
        width: 300px;
        height: 800px;
        z-index: 9999;
        display: none;
    }

    .v-route {
        margin-left: 20px;
    }
}
</style>