<template>
    <div class="v-incpector">
        <div class="v-container">
            <div class="v-incpector__inner">
                <vSideBar />
                <div class="v-incpector__data">
                    <h1 class="v-name__inpector">Инструктора:</h1>
                    <div class="v-incpector__cards">
                        <vCardIncpector
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
import vCardIncpector from '@/components/Incpector/Card/v-card-incpector.vue';
import vLoader from '../../components/Loader/v-loader.vue'
import { mapActions, mapGetters } from 'vuex';
import API from '@/api/api';
import config from '@/config/config';
    
    export default {
    
        components: {
            vSideBar,
            vLoader,
            vCardIncpector
        },

        data() {
            return {
                items: []
            }
        },

        mounted() {
            API.post(`${config.api.url}/auth/incpector/all`)
            .then(response => {
                this.items = response.data
            })
        },
    }
    </script>
      
    <style>
    .v-incpector__inner {
      display: flex;
      justify-content: space-between;
    }
    
    .v-incpector__data {
        width: 1080px;
        margin-left: 25px;
        margin-top: 80px;
    }
    
    .v-incpector__cards {
        display: flex;
        flex-wrap: wrap;
        align-content: flex-start;
    }
    </style>
      