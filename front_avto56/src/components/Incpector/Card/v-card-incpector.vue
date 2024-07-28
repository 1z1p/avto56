<template>
    <div class="v-card__incpector">
        <img
            width="300"
            height="220" 
            :src="image" 
            alt="">
        <div class="v-incpectors__data">
            <h3>{{ title }}</h3>
            <vLinkVue
                text="Посмотреть" 
                :route="'/incpector/'+id" />
            <p style="margin: 20px;"></p>
        </div>
    </div>
</template>
    
<style scoped>
img {
    border-radius: 10px 10px 0px 0px;
}

.v-card__incpector {
    margin: 15px;
    width: 300px;
    height: 100%;
    background: #e0e0e0;
    border-radius: 10px;
    border: 1px solid #e0e0e0;
}

.v-incpectors__data {
    margin-left: 10px;
}

h3 {
    margin: 25px 0px;
    word-break:break-all;
    font-size: 16.1px;
}
</style>

<script>
import vButtonVue from '@/components/UI/Button/v-button.vue'
import vLinkVue from '@/components/UI/Link/v-link.vue'

export default {
    props: {
        image: String,
        title: String,
        id: String,
    },

    components: {
        vButtonVue,
        vLinkVue
    }
}

</script>