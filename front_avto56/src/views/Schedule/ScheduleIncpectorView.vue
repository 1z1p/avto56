
<template>
    <div class="v-schedule">
        <div class="v-container">
            <div class="v-inner-top">
                <vSideBarVue />
                <div 
                v-bind:class="{'v-schedule__data': true, 'v-schedule__load': load}">
                    <h2>Выберите инструктора</h2>
                    <vLoaderVue 
                        v-if="load"
                    />
                    <div class="v-schedule__items">
                        <vItemVue
                            v-for="item in items"
                            :key="item" 
                            :text="item.incpector"
                            :link="item.incpector"
                            :week="week"
                            :year="year"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vSideBarVue from '@/components/SideBar/v-side-bar.vue'
import vLoaderVue from '@/components/Loader/v-loader.vue'
import vItemVue from '@/components/UI/Item/v-item.vue'
import API from '@/api/api'
import config from '@/config/config'

export default {
    components: {
        vSideBarVue,
        vLoaderVue,
        vItemVue
    },

    data() {
        return {
            load: true,
            items: [],
            week: "",
            year: ""
        }
    },

    mounted() {
        this.Incpector()
        this.Week()
        this.year = new Date().getFullYear()
    },

    methods: {
        Incpector() {
            API.post(`${config.api.url}/auth/users/incpector`)
            .then(response => {
                this.items = response.data
                this.load = false
            })
        },

        Week() {
            Date.prototype.getWeek = function() {
                let onejan = new Date(this.getFullYear(), 0, 1);
                return Math.ceil((((this - onejan) / 86400000) + onejan.getDay() + 1) / 7);
            }
            this.week = (new Date()).getWeek();
        }
    }

}
</script>

<style scoped>
.v-schedule__data {
    width: 980px;
    margin: 20px;
    position: relative;
}

.v-schedule__load {
    opacity: 0.6;
}

.v-schedule__items {
    margin-top: 30px;
}
</style>