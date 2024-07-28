
<template>
    <div class="v-schedule-name">
        <vModalVue
            :users="TableAdmin.users" 
            v-if="Modal" />
        <div class="v-container">
            <div class="v-inner-top">
                <vSideBarVue />
                <div 
                v-bind:class="{'v-schedule-name__data': true, 'v-schedule-name__load': LoadAdmin}">
                    <h2>Расписание: {{ $route.params.name }} </h2>
                    <p>Неделя: {{ $route.params.week }} </p>
                    <p>Месяц: {{ month }}</p>
                    <vLoaderVue 
                        v-if="LoadAdmin"
                    />
                    <div class="v-schedule-name__items">
                        <h3 class="v-schedule-name__error">{{ MessageAdmin }}</h3>
                        <vTable
                            :table="TableAdmin.table"
                            params="update_admin"
                            :nameUser="Role"
                            :users="TableAdmin.users"
                        />
                    </div>
                    <div class="v-inner">
                        <router-link 
                            :to="'/schedule/incpector/'+$route.params.name+'/'+$route.params.year+'/'+(Number($route.params.week) - 1)"
                            @click.prevent="submitArray(this.$route.params.week - 1)" 
                            class="v-arrow">←</router-link>
                        <router-link
                            :to="'/schedule/incpector/'+$route.params.name+'/'+$route.params.year+'/'+(Number($route.params.week) + 1)" 
                            @click.prevent="submitArray(Number(this.$route.params.week) + 1)" 
                            class="v-arrow">→</router-link>
                    </div>
                    <div class="v-pagination__container">
                        <p>Выбор недели:</p>
                        <div class="v-table__pagination">
                            <router-link 
                                :to="'/schedule/incpector/'+$route.params.name+'/'+$route.params.year+'/'+page" 
                                v-bind:class="{'page': true}" 
                                v-for="page in 52"
                                :key="page"
                                @click.prevent="submit(page)"
                            >{{page}}</router-link>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vSideBarVue from '@/components/SideBar/v-side-bar.vue'
import vLoaderVue from '@/components/Loader/v-loader.vue'
import vTable from '@/components/Table/v-table.vue'
import { mapActions, mapGetters, mapMutations } from 'vuex'
import vModalVue from '@/components/Modal/v-modal.vue'

export default {
    components: {
        vSideBarVue,
        vLoaderVue,
        vTable,
        vModalVue,
    },

    data() {
        return {
            month: "",
        }
    },

    computed: mapGetters(['Role', 'Modal', 'TableAdmin', 'LoadAdmin', 'MessageAdmin']),
    methods: {
        ...mapActions(['fetchTableAdmin']),
        ...mapMutations(['updateNumber']),
        getDateOfIsoWeek(week, year) {
            week = parseFloat(week);
            year = parseFloat(year);
        
            if (week < 1 || week > 53) {
            throw new RangeError("ISO 8601 weeks are numbered from 1 to 53");
            } else if (!Number.isInteger(week)) {
            throw new TypeError("Week must be an integer");
            } else if (!Number.isInteger(year)) {
            throw new TypeError("Year must be an integer");
            }
        
            const simple = new Date(year, 0, 1 + (week - 1) * 7);
            const dayOfWeek = simple.getDay();
            const isoWeekStart = simple;

            isoWeekStart.setDate(simple.getDate() - dayOfWeek + 1);
            if (dayOfWeek > 4) {
                isoWeekStart.setDate(isoWeekStart.getDate() + 7);
            }

            if (isoWeekStart.getFullYear() > year ||
                (isoWeekStart.getFullYear() == year &&
                isoWeekStart.getMonth() == 11 &&
                isoWeekStart.getDate() > 28)) {
                throw new RangeError(`${year} has no ISO week ${week}`);
            }
        
            return isoWeekStart;
        },

        selectWeek(date) {
            let selectWeek = [""];
            for (let i=2; i<9; i++) {
                let weekday = new Date(date)
                let selectedWeekdayIndex = date.getDay() 
                let selectedDay = date.getDate()
                weekday.setDate(selectedDay - selectedWeekdayIndex + i)
                selectWeek = [...selectWeek, weekday.getUTCDate()]
            }
            return selectWeek;
        },

        monthSelect() {
        const month = new Date().getUTCMonth() + 1
        if(month == 1) {
            this.month = 'Январь'
        }
        if(month == 2) {
            this.month = 'Февраль'
        }
        if(month == 3) {
            this.month = 'Март'
        }
        if(month == 4) {
            this.month = 'Апрель'
        }
        if(month == 5) {
            this.month = 'Май'
        }
        if(month == 6) {
            this.month = 'Июнь'
        }
        if(month == 7) {
            this.month = 'Июль'
        }
        if(month == 8) {
            this.month = 'Август'
        }
        if(month == 9) {
            this.month = 'Сентябрь'
        }
        if(month == 10) {
            this.month = 'Октябрь'
        }
        if(month == 11) {
            this.month = 'Ноябрь'
        }
        if(month == 12) {
            this.month = 'Декабрь'
        }
        },

        submit(page) {
            const number = this.selectWeek(this.getDateOfIsoWeek(page, this.$route.params.year))
            this.updateNumber(number)
            this.fetchTableAdmin({
                'name': this.$route.params.name,  
                'week': `${page}`, 
                'year': this.$route.params.year})
            this.monthSelect()
        },

        submitArray(week) {
            if(week == 53) {} else {
                const number = this.selectWeek(this.getDateOfIsoWeek(week, this.$route.params.year))
                this.updateNumber(number)
                this.fetchTableAdmin({
                    'name': this.$route.params.name,  
                    'week': `${week}`, 
                    'year': this.$route.params.year})
                this.monthSelect()
            }
        },
    },
    mounted() {
        this.fetchTableAdmin({
            "name": this.$route.params.name,  
            "week": this.$route.params.week, 
            "year": this.$route.params.year})
        this.monthSelect()
        const number = this.selectWeek(this.getDateOfIsoWeek(this.$route.params.week, this.$route.params.year))
        this.updateNumber(number)
    },

}
</script>

<style scoped>
.v-schedule-name__data {
    margin: 20px;
    width: 980px;
    position: relative;
}

.v-schedule-name__load {
    opacity: 0.6;
} 

.v-schedule-name__error {
    position: absolute;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    text-align: center;
    top: 170px;
    color: #ff0000;
}

.v-arrow {
    background: lightgrey;
    padding: 8px 12px 10px 12px;
    border-radius: 12px;
    line-height: 20px;
    cursor: pointer;
    text-decoration: none;
    color: #000;
}

.v-pagination__container {
    max-width: 320px;
    margin: 0 auto;
    margin-top: 100px;
}

.v-table__pagination {
    display: flex;
    overflow-y: scroll; 
    width: 300px;
    height: 60px;
    background: rgb(254, 254, 254);
}

.page {
    width: 100%;
    height: 30px;
    border: solid 1px #e7e7e7;
    margin-right: 4px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    margin: 5px 2.5px;
    padding: 0px 12px;
    text-decoration: none;
    color: #000;
}

.page:hover {
    background: #eaeaea;
    cursor: pointer;
}

@media (max-width: 950px) {
  .v-schedule-name__data {
    margin: 0px 10px;
  }

  .v-schedule-name__items {
    overflow-y: scroll;
    width: 550px;
  }
}

@media (max-width: 800px) {
  .v-schedule-name__items {
    overflow-y: scroll;
    width: 450px;
  }
}

@media (max-width: 500px) {
  .v-schedule-name__items{
    overflow-y: scroll;
    width: 350px;
  }
}

@media (max-width: 300px) {
  .v-schedule-name__items {
    overflow-y: scroll;
    width: 300px;
  }
}
</style>