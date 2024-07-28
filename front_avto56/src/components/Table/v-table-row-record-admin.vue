<template>
    <div class="v-table-row">
        <div class="row">{{ tableData.time }}</div>
        <div 
            class="row"
            v-for="item in week"
            :key="item"
        >
        <button
            @click.prevent="submit(tableData.id, item)"
            class="v-table-row__cabet"
            v-if="tableData[item]">{{ tableData[item] }}</button>
        <button
            @click.prevent="submit(tableData.id, item)"
            v-if="!tableData[item]">Изменить</button>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapMutations } from 'vuex'
import vButtonVue from '../UI/Button/v-button.vue'

export default {
    components: {
        vButtonVue
    },

    props: {
        tableData: Object,
        users: Object,
        modelValue: String
    },

    computed: mapGetters(['Role']),

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
            ],
        }
    },

    methods: {
        ...mapMutations(['updateModal']),
        submit(id, week) {
            this.updateModal([true, id, week])
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
    flex-basis:25%;
    padding: 8px 0px;
    text-align: center;
    font-size: 18px;
    width: 242px;
    border-left: solid 1px #e7e7e7;
    border-right: solid 1px #e7e7e7;
    border-bottom: solid 1px #e7e7e7;
    word-break: break-all;
}
.v-table-row__cabet {
    color: rgb(200, 200, 200);
}


button {
    border: 0px;
    background: transparent;
    font-size: 16px;
    cursor: pointer;
    transition: .3s;
}

button:hover {
    font-size: 18px;
}

</style>