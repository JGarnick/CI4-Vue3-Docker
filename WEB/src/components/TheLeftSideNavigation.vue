<script setup>
let emits = defineEmits(['navigationClosed'])
let props = defineProps({
    navigation: Boolean
})

</script>

<template>
    <VNavigationDrawer @update:model-value="$emit('navigationClosed')" :model-value="props.navigation" temporary :border="true" :elevation="10">
        <VContainer>
            <RouterLink active-class="font-weight-bold" to="lists">Lists</RouterLink>
        </VContainer>
    </VNavigationDrawer>
</template>

<style scoped>
a{font-size:20px;color:white;}
</style>