<template>
    <span class="v-loader"></span>
</template>

<style scoped>
.v-loader {
    width: 48px;
    height: 48px;
    border: 5px solid #000000;
    border-bottom-color: transparent;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;

    position: absolute;
    left: 0; 
    right: 0; 
    margin-left: auto; 
    margin-right: auto; 
    top: 150px;
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
} 
</style>