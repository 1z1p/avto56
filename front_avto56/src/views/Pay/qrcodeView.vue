<template>
    <div class="v-pay">
        <div class="v-container">
            <div class="v-pay__inner">
                <vSideBar />
                <div class="v-pay__data">
                    <h1>Оплата по QR-коду</h1>
                    <h1>Цена: {{ $route.params.price }}р</h1>
                    <img src="/image/qr.jfif" alt="">
                    <h2>Отсканируйте QR код в мобильном приложении банка.</h2>
                </div>
            </div>
        </div>
    </div>
    </template>
        
    <script>
    import vSideBar from '@/components/SideBar/v-side-bar.vue';
    
    export default {
        components: {
            vSideBar,
        },

    }
    </script>
        
    <style>
    .v-pay__inner {
        display: flex;
        justify-content: space-between;
    }
    
    .v-pay__data {
        width: 1080px;
        margin-left: 25px;
        margin-top: 80px;
    }
    
    .v-pay__cards {
        display: flex;
        flex-wrap: wrap;
        align-content: flex-start;
    }
    </style>
          