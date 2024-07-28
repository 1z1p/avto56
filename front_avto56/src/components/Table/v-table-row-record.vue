<template>
    <div class="v-table-row">
            <div class="row">{{ tableData.time }}</div>
            <div 
                v-for="item in week"
                :key="item"
                v-bind:class="{'row': true, 'v-row__false': tableData[item], 'v-row__true': !tableData[item]}">

                <span v-if="!tableData[item]">
                    <button
                        class="v-row__btn"
                        v-if="item != 'sunday' && tableData[item] != name" 
                        @click.prevent="submit(tableData.id, item)">Записаться {{ tableData[item] }}</button>
                    <span 
                        v-if="item == 'sunday'" 
                        class="v-row__occupied">Закрыто</span>
                </span>
                <span v-if="tableData[item] == name">{{ name }}</span>
                <span class="v-row__occupied" v-if="tableData[item] != name && tableData[item] != ''">Занято</span>
            </div>
        </div>
</template>

<script>
import API from '@/api/api'
import config from '@/config/config'
import router from '@/router'

export default {
    props: {
        tableData: Object,
        name: Object
    },

    data() {
        return {
            week: [
                "monday",
                "tuesday",
                "wednesday",
                "thursday",
                "friday",
                "saturday",
                "sunday",
            ]
        }
    },

    methods: {
        submit(id, week) {
            API.post(`${config.api.url}/auth/table/update`, {
                id: id,
                week: week
            })
            .then(response => {
                alert('Вы успешно записались')
                router.push('/table')
            })
        }
    }
}
</script>

<style scoped>
.v-table-row {
    display: flex;
    justify-content: space-around;
}

.row {
    flex-basis: 25%;
    padding: 8px 16px;
    text-align: left;
    font-size: 18px;
    border-left: solid 1px #e7e7e7;
    border-right: solid 1px #e7e7e7;
    border-bottom: solid 1px #e7e7e7;
}

.v-row__btn {
    border: 0px;
    background: transparent;
    font-size: 14px;
    transition: .3s;
    cursor: pointer;
}

.v-row__btn:hover {
    font-size: 15px;
    color: lightgrey;
}

.v-row__occupied {
    color: lightcoral;
}
</style>