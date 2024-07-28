<template>
    <div class="v-side">
        <div class="v-route">
            <div class="v-route__close">
                <vBurgerVue
                    :vIF="true"
                    :paramsSubmit="false"
                    icon="✕"
                />
            </div>
            <VSideBarGroup
                icon="home"  
                :links="[{'name': 'Профиль', 'route': '/development'}]"
            />
            <VSideBarGroup
                v-if="Role == 'cabet' || Role == 'incpector'"
                icon="calendar" 
                categories="Теория"
                :links="[{'name': 'Раписание', 'route': '/table'}, {'name': 'Записаться на занятие', 'route': '/table/create'}]"
            />
            <VSideBarGroup
                v-if="Role == 'cabet'"
                icon="id-card" 
                categories="Практика"
                :links="[{'name': 'Инструкторы', 'route': '/development'}]"
            />
            <VSideBarGroup
                v-if="Role == 'cabet'"
                icon="credit-card" 
                categories="Финансы"
                :links="[{'name': 'Оплатить обучение', 'route': '/development'}]"
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

<script>
import vButtonVue from '../../UI/Button/v-button.vue';
import VSideBarGroup from '../v-side-bar-group.vue';
import router from '@/router';
import config from '@/config/config';
import API from '@/api/api';
import vBurgerVue from '@/components/UI/Burger/v-burger.vue';
import { mapGetters, mapMutations } from 'vuex';

export default {
    components: {
        VSideBarGroup,
        vButtonVue,
        vBurgerVue
    },

    computed: mapGetters(['Role']),

    methods: {
        ...mapMutations(['updateMenu']),
        
        logout() {
            API.post(`${config.api.url}/auth/logout`)
            .then(response => {
                localStorage.removeItem('access_token')
                localStorage.removeItem('role')
                this.updateMenu(false)
                router.push('/')
            })
        }
    }
}
</script>

<style scoped>
.v-side {
    width: 300px;
    height: 100vh;
    border-right: 2px solid #ff0000;
    position: relative;
}

.v-route {
    margin-left: 10px;
}

.v-route__close {
    position: absolute;
    right: 70px;
    top: -10px;
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
        top: 0px;
    }

    .v-route {
        margin-left: 20px;
    }
}
</style>