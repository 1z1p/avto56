<template>
<div class="v-incpector">
    <div class="v-container">
        <div class="v-incpector__inner">
            <vSideBar />
            <div class="v-incpector__data">
                <div class="v-incpector__image">
                    <img :src="item.image" width="300" height="250" alt="">
                </div>
                <div style="margin-top: 10px;">
                    <h3><span>Автомобиль:</span> {{ item.mark }}</h3>
                    <h3><span>Гос. Номер:</span> {{ item.number_car }}</h3>
                    <h3><span>ФИО инструктора:</span> {{ item.name }}</h3>
                    <h3><span>Номер телефона:</span> {{ item.phone }}</h3>
                    <h3><span>Телеграмм:</span> {{ item.telegram }}</h3>
                    <vButtonVue
                        v-if="item.incpetor_user == true"
                        text="Выбрать"
                        @click="submit(item.id)" 
                         />
                </div>
            </div>
        </div>
    </div>
</div>
</template>
    
<script>
import vSideBar from '@/components/SideBar/v-side-bar.vue';
import vCardIncpector from '@/components/Incpector/Card/v-card-incpector.vue';
import vLoader from '../../components/Loader/v-loader.vue'
import { mapActions, mapGetters } from 'vuex';
import API from '@/api/api';
import config from '@/config/config';
import vButtonVue from '@/components/UI/Button/v-button.vue';
import router from '@/router';

export default {

    components: {
        vSideBar,
        vLoader,
        vCardIncpector,
        vButtonVue
    },

    data() {
        return {
            item: []
        }
    },

    mounted() {
        this.IncpectorOne()
    },
    methods: {
        submit(id) {
            API.post(`${config.api.url}/auth/incpector/choose`, {
                id: id
            })
            .then(response => {
                alert("Успешно выбрали инструктора!")
                router.push('/table')
            })
            .catch(error => {
                alert("Ошибка!")
            })
        },

        async IncpectorOne() {
            await API.post(`${config.api.url}/auth/incpector/show`, {
                id: this.$route.params.id
            })
            .then(response => {
                this.item = response.data[0]
            })
        }
    },
}
</script>
    
<style>
.v-incpector__image {
    display: flex;
    justify-content: space-between;
}

.v-incpector__image > img {
    border: 1px solid #e0e0e0;
}

.v-incpector__inner {
    display: flex;
    justify-content: space-between;
}

.v-incpector__data {
    width: 1080px;
    margin-left: 25px;
    margin-top: 80px;
}

.v-incpector__cards {
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
}
</style>
      