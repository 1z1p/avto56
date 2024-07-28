<template>
  <div class="home">
    <VSignIn />
  </div>
</template>

<script lang="ts">
import VSignIn from '../components/Form/Signin/v-sign-in.vue'

export default {
  name: 'HomeView',
  components: {
    VSignIn
  }
}
</script>
