<template>
    <div class="v-table-row">
        <div class="row">{{ tableData.id }}</div>
        <div class="row">{{ tableData.name }}</div>
        <div class="row">{{ tableData.username }}</div>
        <div class="row">{{ tableData.password }}</div>
        <div class="row">{{ tableData.incpector }}</div>
        <div class="row">{{ tableData.created_at }}</div>
        <div class="row">{{ classes }}</div>
        <div class="row">
            <vButtonVue
                text="Удалить"
                style="padding: 5px 10px; font-size: 15px; width: 80px;"
                @click.prevent="Delete(tableData.id)" 
            />
        </div>
    </div>
</template>

<script>
import vButtonVue from '@/components/UI/Button/v-button.vue'
import API from '@/api/api'
import config from '@/config/config'

export default {
    components: {
        vButtonVue
    },

    props: {
        tableData: Object,
        classes: Number,
    },

    methods: {
        Delete(id) {
            API.post(`${config.api.url}/auth/users/delete`, {
                id: id
            })
            .then(response => {
                alert(response.data.message)
            })
        }
    },

}
</script>

<style scoped>
.v-table-row {
    display: flex;
    justify-content: space-around;
}

.row {
    flex-basis:25%;
    padding: 8px 16px;
    text-align: left;
    font-size: 14px;
    width: 112px;
    border-left: solid 1px #e7e7e7;
    border-right: solid 1px #e7e7e7;
    border-bottom: solid 1px #e7e7e7;
    word-break: break-all;
}
.v-table__user {
    background: rgb(200, 200, 200);
}

</style>