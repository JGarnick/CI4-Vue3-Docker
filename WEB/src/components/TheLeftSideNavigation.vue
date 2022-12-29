<script setup>
let emits = defineEmits(['drawerClosed'])
let props = defineProps({
    drawer: Boolean
})

</script>

<template>
    <VNavigationDrawer @update:model-value="$emit('drawerClosed')" :model-value="props.drawer" temporary :border="true" :elevation="10">
        <VContainer>
            <RouterLink active-class="font-weight-bold" to="lists">Lists</RouterLink>
        </VContainer>
    </VNavigationDrawer>
</template>

<style scoped>
a{font-size:20px;color:white;}
</style>