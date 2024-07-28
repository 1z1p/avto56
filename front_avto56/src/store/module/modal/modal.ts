import API from '@/api/api'
import config from '@/config/config'
import router from '@/router'
import iModal from '@/store/Interface/interfaceModal'
import {Module} from 'vuex'

const ModalModule: Module<iModal, {}> = {
    state: {
        openModel: false,
        id: "",
        week: ""
    },

    mutations: {
        updateModal(state: any, data: string) {
            state.openModel = data[0]
            state.id = data[1]
            state.week = data[2]
        }
    },

    actions: {
        fetchBot({commit, state}, data) {
            API.post(`${config.api.url}/auth/table/admin/bot`, {
                id: state.id,
                week: state.week,
                weekNumber: data.week,
                year: data.year,
                name: data.name
            })
            .then(response => {
                // console.log(response);       
            })
        },

        fetchWritingTable({commit, state}, name) {
            API.post(`${config.api.url}/auth/table/admin/update`, {
                id: state.id,
                week: state.week,
                name: name,
            })
            .then(response => {
                commit('updateModal', [false, "", ""])   
            })
            
        }
    },

    getters: {
        Modal(state: any) {
            return state.openModel
        },

        ModalData(state: any) {
            const data = {
                id: state.id,
                week: state.week
            }
            return data
        }
        
    }
}

export default ModalModule