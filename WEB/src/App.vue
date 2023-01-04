<script setup>
import { ref, watch, onMounted } from 'vue';
import {useSnackbar} from 'vue3-snackbar'
import TheHeader from './components/TheHeader.vue';
import TheLeftSideNavigation from './components/TheLeftSideNavigation.vue';
import TheMainContent from './components/TheMainContent.vue';
import useEventBus from './composables/eventBus';

const drawer = ref(false)
const snackbar = useSnackbar()
const {bus} = useEventBus()

function changeDrawer(){
  drawer.value = !drawer.value
}

watch(()=>bus.value.get('triggerToast'), (val)=>{
  const [toast] = val ?? []
  snackbar.add(toast)
})

</script>

<template>
  <VApp theme="dark">
    <TheHeader @drawerChange="changeDrawer"></TheHeader>
    
    <teleport to="body">
        <vue3-snackbar top right :duration="2300"></vue3-snackbar>
    </teleport>
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
