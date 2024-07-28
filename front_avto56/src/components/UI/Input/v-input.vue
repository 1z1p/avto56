<template>
    <div class="v-input">
        <input
            :type="type" 
            :placeholder="placeholder"
            v-bind="$attrs"
            @input="(e) => $emit('update:modelValue',e.target.value)"
        />
    </div>
</template>

<script>

export default {
    props: {
        type: String,
        placeholder: String,
        modelValue: String
    },
}
</script>

<style scoped>
input {
    width: 100%;
    height: 34px;
    font-size: 18px;
    padding-left: 5px;
    margin: 9px 0px;
    border: 0px;
    border-bottom: 1.5px solid #000;
    outline: none;
}
</style>