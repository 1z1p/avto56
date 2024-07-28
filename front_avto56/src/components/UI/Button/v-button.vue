<template>
    <button class="v-btn" :disabled="disabled">
        {{ text }}
    </button>
</template>

<script lang="ts">

export default {
    props: {
        text: String,
        disabled: Boolean
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
}

.v-btn:hover {
    background: #bababa;
}

@media (max-width: 1100px) {
    .v-btn {
        width: 110px;
        font-size: 16px;
        margin: 9px 5px;
    }
}
</style>