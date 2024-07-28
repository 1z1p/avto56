<template>
<div class="v-video">
    <div class="v-container">
        <div class="v-video__inner">
            <vSideBar />
            <div class="v-video__data">
                <video width="800" height="500" controls="controls" ref="videoPlayer"></video>
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
        vItemVideo,

    },

    data() {
        return {
            item: []
        }
    },

    async mounted() {
        await API.post(`${config.api.url}/auth/video/show`, {
            id: this.$route.params.id
        })
        .then(response => {
            this.item = response.data[0]
            this.$refs.videoPlayer.src = response.data[0].video;
        })
    }
}
</script>
    
<style>
video {
    border: 1px solid #e0e0e0;
}

.v-video__inner {
    display: flex;
    justify-content: space-between;
}

.v-video__data {
    width: 1080px;
    margin-left: 25px;
    margin-top: 80px;
}

.v-video__cards {
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
}
</style>
      