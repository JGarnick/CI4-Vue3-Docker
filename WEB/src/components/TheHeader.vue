<script setup>
import {useRouter} from "vue-router"
let router = useRouter()
let props = defineProps({
  drawer: Boolean
})

let emits = defineEmits(['drawerChange'])

</script>
<template>
    <VAppBar theme="dark">
      <VAppBarTitle style="cursor:pointer" @click="router.push('/')">CodeIgnitor 4 Frontend</VAppBarTitle>
      <VAppBarNavIcon @click="$emit('drawerChange')"></VAppBarNavIcon>
    </VAppBar>
</template>

<style>
.v-toolbar-title{flex:none !important;margin-right:1em}
</style>