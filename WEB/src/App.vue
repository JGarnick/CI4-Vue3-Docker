<script setup>
import { ref, watch } from 'vue';
import {useSnackbar} from 'vue3-snackbar'
import TheHeader from './components/TheHeader.vue';
import TheLeftSideNavigation from './components/TheLeftSideNavigation.vue';
import TheMainContent from './components/TheMainContent.vue';
import useEventBus from './composables/eventBus';
import { useRightDrawerStore } from './stores/rightDrawer.js'
import TheRightSideDrawer from './components/TheRightSideDrawer.vue'

const navigation = ref(false)
const snackbar = useSnackbar()
const {bus} = useEventBus()
const rightDrawer = useRightDrawerStore()

function changeNavigation(){
  navigation.value = !navigation.value
}

watch(()=>bus.value.get('triggerToast'), (val)=>{
  const [toast] = val ?? []
  snackbar.add(toast)
})

function closeRightDrawer(){
  rightDrawer.close()
}

</script>

<template>
  <VApp theme="dark">
    <TheHeader @navigationChange="changeNavigation"></TheHeader>
    <teleport to="body">
        <vue3-snackbar top right :duration="2300"></vue3-snackbar>
    </teleport>
    <TheLeftSideNavigation @navigationClosed="navigation = false" :navigation="navigation"></TheLeftSideNavigation>
    <TheMainContent></TheMainContent>
    <TheRightSideDrawer @right-drawer-closed="closeRightDrawer" :open="rightDrawer.isOpen" :data="rightDrawer.data"></TheRightSideDrawer>
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
