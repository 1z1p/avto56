<template>
<div class="v-type">
    <div class="v-container">
        <div class="v-type__inner">
            <vSideBar />
            <div class="v-type__data">
                <h1 class="v-name__inpector">Видео уроки:</h1>
                <div class="v-type__cards">
                    <vCardVideo
                        v-for="item in items"
                        :id="item.id"
                        :title="item.name" 
                        :image="item.image"
                        :key="item"    
                    />
                </div>
            </div>
        </div>
    </div>
</div>
</template>
    
<script>
import vSideBar from '@/components/SideBar/v-side-bar.vue';
import vCardVideo from '@/components/Video/Card/v-card-video.vue';
import vItemVideo from '@/components/UI/Item/v-item-video.vue';
import vLoader from '../../components/Loader/v-loader.vue'
import { mapActions, mapGetters } from 'vuex';
import API from '@/api/api';
import config from '@/config/config';

export default {

    components: {
        vSideBar,
        vLoader,
        vCardVideo,
        vItemVideo
    },

    data() {
        return {
            items: []
        }
    },

    mounted() {
        API.post(`${config.api.url}/auth/video/all`, {
            "type": this.$route.params.type
        }).then(response => {
            this.items = response.data
            console.log(response);
        })
    }
}
</script>
    
<style>
.v-type__inner {
    display: flex;
    justify-content: space-between;
}

.v-type__data {
    width: 1080px;
    margin-left: 25px;
    margin-top: 80px;
}

.v-type__cards {
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
}
</style>
      