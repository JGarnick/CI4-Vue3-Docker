<script setup>
import {useRouter} from "vue-router"
let router = useRouter()
let props = defineProps({
  navigation: Boolean
})

let emits = defineEmits(['navigationChange'])

</script>
<template>
    <VAppBar theme="dark">
      <VAppBarTitle style="cursor:pointer" @click="router.push('/')">CodeIgnitor 4 Frontend</VAppBarTitle>
      <VAppBarNavIcon @click="$emit('navigationChange')"></VAppBarNavIcon>
    </VAppBar>
</template>

<style>
.v-toolbar-title{flex:none !important;margin-right:1em}
</style>