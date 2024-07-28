<template>
    <div class="table">
      <div class="v-container">
        <div class="v-table__inner">
          <vSideBar />
          <div class="v-table__data" v-if="data['incpector'] != 'default'">
            <h1 class="v-name__insert">Записаться:</h1>
            <h3 class="v-name__insert">Сколько раз можно записаться: {{ data.read }}</h3>
            <div class="v-table__params">
                <v-loader 
                  v-if="load"
                />
                <div
                  v-if="data.read >= 1" 
                  v-bind:class="{'v-table__writing': true, 'v-table__load': load}">
                  <vTable 
                    params="update"
                    :table="data.table"
                    :nameUser="data.name"
                  />
                </div>
                <h2 class="v-table__error" v-if="data.read == 0">Больше записаться нельзя</h2>
            </div>
          </div>
          <div v-if="data['incpector'] == 'default'" class="v-table__data">
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
import vLoader from '../../components/Loader/v-loader.vue'
import config from '@/config/config';

export default {
    components: {
        vTable,
        vSideBar,
        vLoader
    },

    data() {
      return {
        load: true,
        data: [],
        month: ""
      }
    },

    mounted() {
        this.allTable()
        this.monthSelect()
    },

    methods: {
      allTable() {
        API.post(`${config.api.url}/auth/table/all`, {
          number: 1,
          schalter: 2
        })
        .then(response => {
          this.data = response.data
          this.load = false
        })
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
      }
    }
}
</script>

<style scoped>
.v-error__name {
    margin-top: 30px;
    text-align: center;
    color: lightcoral;
}

.v-table__inner {
  display: flex;
  justify-content: space-between;
}

.v-table__data {
  width: 980px;
  margin-left: 15px;
}

.v-name__insert {
  margin: 15px 0px;
}

.v-table__error {
  color: lightcoral;
}
.v-table__params {
  position: relative;
}

.v-table__load {
  opacity: 0.5;
}

@media (max-width: 950px) {
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
