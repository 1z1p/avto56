import { createStore } from 'vuex'
import menu from './module/menu/menu'
import RoleUsers from './module/users/roleUsers'
import Modal from './module/modal/modal'
import TableAdmin from './module/table/table'
export default createStore({
  modules: {
    menu,
    RoleUsers,
    Modal,
    TableAdmin
  }
})
