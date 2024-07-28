<template>
    <router-link 
        :to="'/schedule/incpector/'+link+'/'+year+'/'+week" 
        class="v-item">
        {{ text }}
    </router-link>
</template>

<script>
export default {
    props: {
        text: String,
        link: String,
        week: Number,
        year: String
    }
}
</script>

<style scoped>
.v-item {
    border: 3px solid #7a7a7a;
    width: 90%;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    display: flex;
    text-decoration: none;
    color: #000;
    margin: 10px 0px;
}
</style>