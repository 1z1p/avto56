<template>
  <VHeader />
  <vSideBarMobile
    class="vMobileSideBar" 
    v-if="Menu" />
  <router-view class="v-view" />
</template>

<script>
import { mapGetters, mapMutations } from 'vuex';
import VHeader from './components/Header/v-header.vue';
import vSideBarMobile from './components/SideBar/mobile/v-side-bar-mobile.vue';

export default {
  components: {
    VHeader,
    vSideBarMobile
  },

  computed: mapGetters(['Menu', 'Role']),

  methods: {
    ...mapMutations(["updateRole"]),
  }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

* {
  padding: 0;
  margin: 0;
  font-family: 'Roboto', sans-serif;
}

.v-container {
  margin: 0 auto;
  max-width: 1300px;
}

.v-inner {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.v-inner-top {
  display: flex;
}

.v-view {
  height: 100vh;
}

.vMobileSideBar {
    display: none;
  }

@media (max-width: 1100px) {
  .vMobileSideBar {
    display: block;
  }
}
</style>
