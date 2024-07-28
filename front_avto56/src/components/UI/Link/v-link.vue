<template>
    <router-link :to="route" class="v-btn">
        {{ text }}
    </router-link>
</template>

<script>

export default {
    props: {
        text: String,
        route: String
    }
}
</script>


<style scoped>
.v-btn {
    background: #7a7a7a;
    font-size: 18px;
    color: #fff;
    padding: 10px 20px;
    border: 0px;
    border-radius: 10px;
    cursor: pointer;
    transition: .3s;
    width: 120px;
    margin: 9px 0px;
    text-decoration: none;
    text-align: center;
}

.v-btn:hover {
    background: #b5b5b5;
}

@media (max-width: 1100px) {
    .v-btn {
        width: 110px;
        font-size: 16px;
        margin: 9px 5px;
    }
}
</style>