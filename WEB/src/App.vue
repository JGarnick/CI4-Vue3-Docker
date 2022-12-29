<script setup>
import { ref } from 'vue';
import TheHeader from './components/TheHeader.vue';
import TheLeftSideNavigation from './components/TheLeftSideNavigation.vue';
import TheMainContent from './components/TheMainContent.vue';

const drawer = ref(false)

function changeDrawer(){
  drawer.value = !drawer.value
}
</script>

<template>
  <VApp theme="dark">
    <TheHeader @drawerChange="changeDrawer"></TheHeader>
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
</style>
