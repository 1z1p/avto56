<template>
    <div class="v-table">
        <div class="v-table__header">
            <p>№</p>
            <p>ФИО</p>
            <p>Имя пользователя</p>
            <p>Пароль</p>
            <p>Инструктор</p>
            <p>Дата создания</p>
            <p>Сколько занятий прошел</p>
            <p>Кнопки</p>
        </div>
        <div class="v-table__body">
           <vTableUsersRow
            v-for="number in table.length"
            :tableData="table[number - 1]"
            :classes="classes[number - 1]"
            :key="number"
           />
        </div>
    </div>
</template>

<script>
import vTableUsersRow from './v-table-users-row.vue'
export default {
    name: "v-table",
    components: {
        vTableUsersRow,
    },

    props: {
        table: Object,
        classes: Object,
    }
}
</script>

<style scoped>
.v-table {
    max-width: 940px;
    width: 940px;
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