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
            @mouseover="hover='Отменить'"
            @mouseleave="hover=tableData[item]"
            v-if="tableData[item] == name">
            <span
                class="v-table-row__cancel"  
                v-if="hover == 'Отменить'">{{hover}}</span>
            <span 
                v-else>{{hover}}</span>
            </button>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters } from 'vuex'

export default {
    props: {
        tableData: Object,
        users: Object,
        modelValue: String,
        name: String,
        incpector: String,
        weekNumber: String
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
            hover: this.name
        }
    },

    methods: {
        ...mapActions(['fetchTableUserCancel', 'fetchTableNext', 'fetchBot']),
        submit(id, week) {
            let confirms = confirm("Вы действительно хотите отменить занятие")

            if(confirms) {
                this.fetchTableUserCancel({
                    id: id,
                    week: week
                })
                let number = Number(this.weekNumber) + 1
                this.fetchBot({
                    id: id,
                    week: week,
                    weekNumber: number,
                    year: "2024",
                    name: this.incpector
                })
            }
            this.fetchTableNext()
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

.v-table-row__cancel {
    color: rgb(181, 71, 71);
}

</style>