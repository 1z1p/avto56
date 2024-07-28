import iMenu from '@/store/Interface/interfaceMenu'
import {Module} from 'vuex'

const MenuModule: Module<iMenu, {}> = {
    state: {
        openMenu: false
    },

    mutations: {
        updateMenu(state: any, menu: boolean) {
            state.openMenu = menu
        }
    },

    getters: {
        Menu(state: any) {
            return state.openMenu
        }
    }
}

export default MenuModule