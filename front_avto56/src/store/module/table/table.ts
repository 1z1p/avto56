import API from '@/api/api'
import config from '@/config/config'
import router from '@/router'
import iTableAdmin from '@/store/Interface/interfaceTableAdmin'
import {Module} from 'vuex'

const TableAdmin: Module<iTableAdmin, {}> = {
    state: {
        table: [],
        load: true,
        message: "",
        number: [],
        tableNext: []
    },

    mutations: {
        updateTableAdmin(state: any, table: object) {
            state.table = table
        },

        updateLoad(state: any, load: boolean) {
            state.load = load
        },

        updateMessage(state: any, message: string) {
            state.message = message
        },

        updateNumber(state: any, number: object) {
            state.number = number
        },

        updateNext( state: any, data: object) {
            state.tableNext = data
        }
    },

    actions: {    
        fetchTableAdmin({commit, state}, data) {
            API.post(`${config.api.url}/auth/table/admin/index`,
            {
                incpector: data.name,
                week: data.week,
                year: data.year,
            })
            .then(response => {
                if(response) {                    
                    commit('updateTableAdmin', response.data)
                    commit('updateLoad', false)
                    if(response.data.table.length == 0) {
                        commit('updateMessage', "Таблица с расписание не найдена!")
                    } else {
                        commit('updateMessage', "")
                    }
                }
            })
        },

        fetchTableNext({commit, state}, data) {
            API.post(`${config.api.url}/auth/table/all`, {
                number: 1
            })
            .then(response => {
                commit('updateNext', response.data)
            })
        },

        fetchTableUserCancel({commit, state}, data) {
            API.post(`${config.api.url}/auth/table/cancel`,
            {
                id: data.id,
                week: data.week,
            })
            .then(response => {
                alert('Вы успешно отменили занятие')
            })            
        },

        fetchBot({commit, state}, data) {
            API.post(`${config.api.url}/auth/users/bot`, {
                id: data.id,
                week: data.week,
                weekNumber: data.weekNumber,
                year: data.year,
                name: data.name
            })
            .then(response => {
                // console.log(response);       
            })
        },
    },

    getters: {
        TableAdmin(state: any) {
            return state.table
        },

        LoadAdmin(state: any) {
            return state.load
        },

        MessageAdmin(state: any) {
            return state.message
        },

        NumberAdmin(state: any) {
            return state.number
        },

        TableNext(state: any) {
            return state.tableNext
        }
    }
}

export default TableAdmin