<template>
    <div class="v-select">
        <select 
            v-bind="$attrs"
            @input="(e) => $emit('update:modelValue',e.target.value)">
            <option value="">{{ placeholder }}</option>
            <option
                v-for="option in options"
                :key="option"
                :value="option.incpector">{{ option.incpector }}</option>
        </select>
    </div>
</template>

<script>

export default {
    props: {
        options: Object,
        placeholder: String,
        modelValue: String
    },
}
</script>

<style scoped>
select {
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