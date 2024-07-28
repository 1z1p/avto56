<template>
    <div class="v-card__video">
        <img
            width="300"
            height="200" 
            :src="image" 
            alt="">
        <div class="v-video__data__all">
            <h3>{{ title }}</h3>
            <vLinkVue
                text="Посмотреть" 
                :route="'/video/lesson/'+ this.$route.params.type +'/'+id" />
            <p style="margin: 20px;"></p>
        </div>
    </div>
</template>
    
<style scoped>
img {
    border-radius: 10px 10px 0px 0px;
}

.v-card__video {
    margin: 15px;
    width: 300px;
    height: 100%;
    background: #e0e0e0;
    border-radius: 10px;
}

.v-video__data__all {
    margin-left: 10px;
}

h3 {
    margin: 15px 0px;
    word-break:break-all;
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