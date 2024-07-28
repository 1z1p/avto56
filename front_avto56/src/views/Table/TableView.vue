<template>
  <div class="table">
    <div class="v-container">
      <div class="v-table__inner">
        <vSideBar />
        <div class="v-table__data" v-if="tableResponse['incpector'] != 'default'">
          <h1 class="v-name__inpector">Раписание:</h1>
          <p>Инструктор: {{ tableResponse.incpector }}</p>
          <p>Месяц: {{ month }}</p>
          <div class="v-table__params">
              <v-loader 
                v-if="load"
              />
              <div class="v-table__grid">
                <div 
                  v-bind:class="{'v-table__writing': true, 'v-table__load': load}">
                  <h2 class="v-table__week">Текущая неделя</h2>
                  <vTable
                    params="all"
                    :nameUser="tableResponse.name" 
                    :table="tableResponse.table"
                  />
                </div>
                <div 
                  v-bind:class="{'v-table__writing': true, 'v-table__load': load}">
                  <h2 class="v-table__week">Следущая неделя</h2>
                  <vTable
                    params="cancel"
                    :incpector="tableResponse.incpector"
                    :weekNumber="tableResponse.week"
                    :nameUser="TableNext.name" 
                    :table="TableNext.table"
                  />
                </div>  
              </div>
          </div>
        </div>
        <div v-if="tableResponse['incpector'] == 'default'" class="v-table__data">
          <h1 class="v-error__name">Для начала выберите инструктора</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vTable from '@/components/Table/v-table.vue';
import vSideBar from '@/components/SideBar/v-side-bar.vue';
import API from '@/api/api';
import config from '@/config/config';
import vLoader from '../../components/Loader/v-loader.vue'
import { mapActions, mapGetters } from 'vuex';

export default {
  components: {
    vTable,
    vSideBar,
    vLoader
  },

  data() {
    return {
      tableResponse: [],
      load: true,
      month: ""
    }
  },

  computed: mapGetters(['TableNext']),

  mounted() {
      this.allTable()
      this.monthSelect()
  },

  methods: {
    ...mapActions(['fetchTableNext']),
    async allTable() {
      API.post(`${config.api.url}/auth/table/all`)
      .then(response => {
        this.tableResponse = response.data
        this.load = false
      })

      this.fetchTableNext()
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
  }
}

</script>

<style>
.v-error__name {
    margin-top: 30px;
    text-align: center;
    color: lightcoral;
}

.v-table__inner {
  display: flex;
  justify-content: space-between;
}

.v-name__inpector {
  margin: 15px 0px;
}

.v-table__data {
  width: 980px;
  margin-left: 15px;
}

.v-table__params {
  position: relative;
  display: flex;
  justify-content: center;
}

.v-table__load {
  opacity: 0.5;
}

.v-table__week {
  margin-top: 25px;
  line-height: 20px;
}

@media (max-width: 950px) {
  .v-table__data {
    margin: 0px 10px;
  }

  .v-table__writing {
    overflow-y: scroll;
    width: 550px;
  }
}

@media (max-width: 800px) {
  .v-table__writing {
    overflow-y: scroll;
    width: 450px;
  }
}

@media (max-width: 500px) {
  .v-table__writing {
    overflow-y: scroll;
    width: 350px;
  }
}

@media (max-width: 300px) {
  .v-table__writing {
    overflow-y: scroll;
    width: 300px;
  }
}
</style>
