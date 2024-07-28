<template>
    <div class="v-table-row">
        <div class="row">{{ tableData.time }}</div>
        <div 
            class="row"
            v-for="item in week"
            :key="item"
        >
            <span 
                v-if="tableData[item] == name || Role == 'incpector' || Role == 'admin'">{{ tableData[item] }}</span>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    props: {
        tableData: Object,
        name: String
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
            ]
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