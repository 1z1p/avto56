<template>
<div class="v-lesson">
    <div class="v-container">
        <div class="v-lesson__inner">
            <vSideBar />
            <div class="v-lesson__data">
                <h1 class="v-name__inpector">Видео уроки:</h1>
                <vItemVideo 
                    text="Теоритические видео"
                    link="theoretical"
                />
                <vItemVideo 
                    text="Практические видео"
                    link="practical"
                />
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

export default {

    components: {
        vSideBar,
        vLoader,
        vCardVideo,
        vItemVideo
    },

    data() {
        return {
            items: [
                {"title": "Урок №1", "image": "Урок №1"},
                {"title": "Урок №2", "image": "Урок №2"},
                {"title": "Урок №3", "image": "Урок №3"},
                {"title": "Урок №4", "image": "Урок №4"},
                {"title": "Урок №5", "image": "Урок №5"},
                {"title": "Урок №6", "image": "Урок №6"},
                {"title": "Урок №7", "image": "Урок №7"},
                {"title": "Урок №8", "image": "Урок №8"},
            ]
        }
    },
}
</script>
  
<style>
.v-lesson__inner {
  display: flex;
  justify-content: space-between;
}

.v-lesson__data {
    width: 1080px;
    margin-left: 25px;
    margin-top: 80px;
}

.v-lesson__cards {
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
}
</style>
  