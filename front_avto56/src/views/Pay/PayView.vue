<template>
<div class="v-pay">
    <div class="v-container">
        <div class="v-pay__inner">
            <vSideBar />
            <div class="v-pay__data">
                <h1>Оплата:</h1>
                <VItemPay
                    v-for="item in items" 
                    :text="item.text"
                    :link="'/qr_code/'+ item.pay"
                    :key="item"
                />
            </div>
        </div>
    </div>
</div>
</template>
    
<script>
import vSideBar from '@/components/SideBar/v-side-bar.vue';
import VItemPay from '../../components/UI/Item/v-item-pay.vue';

export default {
    components: {
        vSideBar,
        VItemPay
    },

    data() {
        return {
            items: [
                {"text": "Оплата вождения", 'pay': 15900},
                {"text": "Оплата теории" , 'pay': 12900},
                {"text": "Первичный экзамен ГИБДД АКПП" , 'pay': 3400},
                {"text": "Первичный экзамен ГИБДД МКПП" , 'pay': 2900},
                {"text": "Пересдача ГИБДД (Автодром + Город) МКПП" , 'pay': 3400},
                {"text": "Пересдача ГИБДД (Автодром + Город) АКПП" , 'pay': 2900},
                {"text": "Восстановление (2000)", 'pay': 2000},
            ]
        }
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
      