<template>
    <div class="v-table">
        <div class="v-table__header">
            <p>Время</p>
            <p>Понедельник</p>
            <p>Вторник</p>
            <p>Среда</p>
            <p>Четверг</p>
            <p>Пятница</p>
            <p>Суббота</p>
            <p>Воскресенье</p>
        </div>
        <div class="v-table__body" v-if="params == 'all'">
            <vTableRowNumberVue
                :number="number"
            />
           <vTableRow
            v-for="row in table"
            :tableData="row"
            :name="nameUser"
            :key="row.id"
           />
        </div>
        <div class="v-table__body" v-if="params == 'cancel'">
            <vTableRowNumberVue
                :number="numberNext"
            />
           <vTableRowCancelVue
            v-for="row in table"
            :tableData="row"
            :incpector="incpector"
            :weekNumber="weekNumber"
            :name="nameUser"
            :key="row.id"
           />
        </div>
        <div class="v-table__body" v-if="params == 'update'">
            <vTableRowNumberVue 
                :number="numberUpdate"
            />
           <vTableRowRecordVue
            v-for="row in table"
            :tableData="row"
            :name="nameUser"
            :key="row.id"
           />
        </div>
        <div class="v-table__body" v-if="params == 'update_admin'">
            <vTableRowNumberVue 
                :number="NumberAdmin"
            />
           <vTableRowRecordAdminVue
            v-for="row in table"
            :tableData="row"
            :users="users"
            :key="row.id"
           />
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import vTableRowCancelVue from './v-table-row-cancel.vue'
import vTableRowNumberVue from './v-table-row-number.vue'
import vTableRowRecordAdminVue from './v-table-row-record-admin.vue'
import vTableRowRecordVue from './v-table-row-record.vue'
import vTableRow from './v-table-row.vue'

export default {
    name: "v-table",
    components: {
        vTableRow,
        vTableRowRecordVue,
        vTableRowRecordAdminVue,
        vTableRowNumberVue,
        vTableRowCancelVue
    },

    computed: mapGetters(['NumberAdmin']),

    data() {
        return {
            number: [],
            numberNext: [],
            numberUpdate: []
        }
    },

    props: {
        table: Object,
        params: String,
        // next: String,
        nameUser: String,
        users: Object,
        incpector: String,
        weekNumber: String
    },

    mounted() {
        const Year = new Date().getUTCFullYear();
        const Weeks = this.Week()
        this.number = this.selectWeek(this.getDateOfIsoWeek(Weeks, Year))
        this.numberNext = this.selectWeek(this.getDateOfIsoWeek(Weeks + 1, Year))
        if(Weeks == 52) {
            this.numberUpdate = this.selectWeek(this.getDateOfIsoWeek(1, Year))
        } else {
            this.numberUpdate = this.selectWeek(this.getDateOfIsoWeek(Weeks + 1, Year))
        }
    },

    methods: {
        getDateOfIsoWeek(week, year) {
            week = parseFloat(week);
            year = parseFloat(year);
        
            if (week < 1 || week > 53) {
            throw new RangeError("ISO 8601 weeks are numbered from 1 to 53");
            } else if (!Number.isInteger(week)) {
            throw new TypeError("Week must be an integer");
            } else if (!Number.isInteger(year)) {
            throw new TypeError("Year must be an integer");
            }
        
            const simple = new Date(year, 0, 1 + (week - 1) * 7);
            const dayOfWeek = simple.getDay();
            const isoWeekStart = simple;

            isoWeekStart.setDate(simple.getDate() - dayOfWeek + 1);
            if (dayOfWeek > 4) {
                isoWeekStart.setDate(isoWeekStart.getDate() + 7);
            }

            if (isoWeekStart.getFullYear() > year ||
                (isoWeekStart.getFullYear() == year &&
                isoWeekStart.getMonth() == 11 &&
                isoWeekStart.getDate() > 28)) {
                throw new RangeError(`${year} has no ISO week ${week}`);
            }
        
            return isoWeekStart;
        },

        selectWeek(date) {
            let selectWeek = [""];
            for (let i=2; i<9; i++) {
                let weekday = new Date(date)
                let selectedWeekdayIndex = date.getDay() 
                let selectedDay = date.getDate()
                weekday.setDate(selectedDay - selectedWeekdayIndex + i)
                selectWeek = [...selectWeek, weekday.getUTCDate()]
            }
            return selectWeek;
        },

        Week() {
            Date.prototype.getWeek = function() {
                let onejan = new Date(this.getFullYear(), 0, 1);
                return Math.ceil((((this - onejan) / 86400000) + onejan.getDay() + 1) / 7);
            }
            return (new Date()).getWeek();
        }
    }
}
</script>

<style scoped>
.v-table {
    max-width: 900px;
    width: 900px;
    margin: 50px auto;
}

.v-table__header {
    display: flex;
    justify-content: space-around;
    border-bottom: solid 1px #e7e7e7;
}

.v-table__header p {
    flex-basis: 25%;
    text-align: center;
    margin-bottom: 8px;
    font-size: 14px;
}

@media (max-width: 1100px) {
    .v-table {
        width: 900px;
    }

    .v-table__header p {
        font-size: 14px;
    }
}
</style>