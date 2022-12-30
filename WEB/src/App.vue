<script setup>
import { ref } from 'vue';
import TheHeader from './components/TheHeader.vue';
import TheLeftSideNavigation from './components/TheLeftSideNavigation.vue';
import TheMainContent from './components/TheMainContent.vue';

const drawer = ref(false)
const defaultSnackbar = {
  location: "top right",
  absolute: true,
  variant:"flat",
  color: "success",
  timeout: 2000
}
const snackbarShow = ref(false)

function changeDrawer(){
  drawer.value = !drawer.value
}

</script>

<template>
  <VApp theme="dark">
    <TheHeader @drawerChange="changeDrawer"></TheHeader>
    <!-- <VBtn class="pt-16" @click="snackbarShow = true">Open Snackbar</VBtn> -->
    <VSnackbar
      :timeout="defaultSnackbar.timeout"
      :variant="defaultSnackbar.variant"
      :color="defaultSnackbar.color"
      :absolute="defaultSnackbar.absolute"
      :location="defaultSnackbar.location"
      v-model="snackbarShow"
    ></VSnackbar>
    <TheLeftSideNavigation @drawerClosed="drawer = false" :drawer="drawer"></TheLeftSideNavigation>
    <TheMainContent></TheMainContent>
  </VApp>
</template>

<style>
#app{
  margin:0;
  max-width:100vw;
  padding:0 !important;
  flex: 1 1 auto;
  text-align:start;
}
.v-snackbar__wrapper{top:64px;}
</style>
