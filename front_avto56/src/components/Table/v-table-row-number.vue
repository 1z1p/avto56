<template>
    <div class="v-table-row">
        <div
            class="row" 
            v-for="num in number"
            :key="num">
            <span v-if="num == ''"></span>
            <span v-else>{{ num }} день</span>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        number: Object,
    },
}
</script>

<style scoped>
.v-table-row {
    display: flex;
    justify-content: space-around;
}

.row:first-child {
    font-size: 17px;
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