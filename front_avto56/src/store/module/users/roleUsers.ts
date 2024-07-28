import API from '@/api/api'
import config from '@/config/config'
import router from '@/router'
import iRoleUsers from '@/store/Interface/interfaceRoleUsers'
import {Module} from 'vuex'

const RoleModule: Module<iRoleUsers, {}> = {
    state: {
        role: ""
    },

    mutations: {
        updateRole(state: any, role: string) {
            state.role = role
        }
    },

    getters: {
        Role(state: any) {
            return state.role
        }
    }
}

export default RoleModule