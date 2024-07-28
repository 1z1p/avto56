<template>
<div class="v-profile">
    <div class="v-container">
        <div class="v-profile__inner">
            <vSideBar />
            <div class="v-profile__data">
                <vLoader 
                    v-if="load"
                />
                <div v-bind:class="{'v-profile__flex': true, 'v-profile__load': load}">
                    <div>
                        <img src="../../assets/user.png" width="200" height="200" alt=""><br>
                        <vButton 
                            text="Загрузить"
                        />
                    </div>
                    <div class="v-data_">
                        <h2><span class="v-profile__item">ФИО:</span> {{ data.name }}</h2>
                        <h2><span class="v-profile__item">Инструктор:</span> {{ data.incpector }}</h2>
                        
                        <div style="margin-top: 25px;">
                            <p>Прогресс практических занятий вы прошли: {{data.classes}}/28</p>
                            <vProgress 
                                :value="data.classes * 100 / 28" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
    
<script>
import vSideBar from '@/components/SideBar/v-side-bar.vue';
import vProgress from '@/components/Progress/v-progress.vue';
import vButton from '@/components/UI/Button/v-button.vue';
import API from '@/api/api';
import config from '@/config/config';
import VLoader from '@/components/Loader/v-loader.vue';

export default {

    components: {
        vSideBar,
        vProgress,
        vButton,
        VLoader
    },

    data() {
        return {
            data: [],
            message: "",
            load: true
        }
    },

    mounted() {
        API.post(`${config.api.url}/auth/users/profile`)
        .then(response => {
            this.data = response.data
            this.load = false
        })
        .catch(error => {
            this.message = error
        })
    },
}
</script>
    
<style>
.v-profile__load {
  opacity: 0.5;
}

.v-profile__flex {
    display: flex;
}

.v-profile__inner {
    display: flex;
    justify-content: space-between;
}

.v-profile__data {
    width: 1080px;
    margin-left: 25px;
    margin-top: 80px;
    display: flex;
}

.v-profile__item {
    font-weight: 300;
}

.v-data_ {
    margin-left: 40px;
}
</style>
      