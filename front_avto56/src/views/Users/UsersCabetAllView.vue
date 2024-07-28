<template>
    <div class="v-cabet-all">
        <div class="v-container">
            <div class="v-inner-top">
                <vSideBarVue />
                <div class="v-cabet-all__data">
                    <h2>Список курсантов</h2>
                    <div class="v-cabet__search">
                        <h3 class="v-cabet-all__error">{{ message }}</h3>
                        <vInputVue 
                            v-model="search"
                            type="text"
                            placeholder="Поиск по ФИО"
                        />
                        <vButtonVue
                            @click.prevent="Search()" 
                            text="Поиск"
                        />
                        <vButtonVue
                            style="margin: 0px 10px;"
                            @click.prevent="AllUsers()" 
                            text="Очистить"
                        />
                    </div>

                    <div 
                        v-bind:class="{'v-cabet-all__table': true, 'v-cabet-all__load': load}">
                        <vLoaderVue 
                            v-if="load"
                        />
                        <div class="v-cabet-all__params">
                            <vTableUsersVue 
                                :table="table"
                                :classes="classes"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vSideBarVue from '@/components/SideBar/v-side-bar.vue'
import vTableUsersVue from '@/components/Table/Users/v-table-users.vue'
import vLoaderVue from '@/components/Loader/v-loader.vue'
import API from '@/api/api'
import config from '@/config/config'
import vInputVue from '@/components/UI/Input/v-input.vue'
import vButtonVue from '@/components/UI/Button/v-button.vue'

export default {
    components: {
        vSideBarVue,
        vTableUsersVue,
        vLoaderVue,
        vInputVue,
        vButtonVue
    },

    data() {
        return {
            load: true,
            table: [],
            classes: [],
            search: "",
            message: ""
        }
    },

    mounted() {
        this.AllUsers()
    },

    methods: {
        Search() {
            if(this.search == "") {
                this.message = "Поле пустое"
            } else {
                this.message = ""
                API.post(`${config.api.url}/auth/users/search`, {
                    search: this.search
                })
                .then(response => {
                    this.table = response.data
                })
            }
        },
        
        AllUsers() {
            API.post(`${config.api.url}/auth/users/all`)
            .then(response => {
                this.table = response.data.table
                this.classes = response.data.classes
                this.load = false
            })
        }
    }
}
</script>

<style scoped>
.v-cabet-all__data {
    width: 980px;
    margin: 20px;
}

.v-cabet-all__table {
    position: relative;
    display: flex;
    justify-content: center;
}

.v-cabet-all__load {
    opacity: 0.5;
}

.v-cabet-all__error {
    color: lightcoral;
}

@media (max-width: 950px) {
  .v-cabet-all__data {
    margin: 0px 10px;
  }

  .v-cabet-all__params {
    overflow-y: scroll;
    width: 550px;
  }
}

@media (max-width: 800px) {
  .v-cabet-all__params {
    overflow-y: scroll;
    width: 450px;
  }
}

@media (max-width: 500px) {
  .v-cabet-all__params{
    overflow-y: scroll;
    width: 350px;
  }
}

@media (max-width: 300px) {
  .v-cabet-all__params {
    overflow-y: scroll;
    width: 300px;
  }
}
</style>