<script setup>
import { useRightDrawerStore } from '@/stores/rightDrawer';

const rightDrawer = useRightDrawerStore()

function performCallback(){
    if (rightDrawer.data.callback) {
        rightDrawer.data.callback()
    }
    rightDrawer.close()
}

let props = defineProps({
    open: Boolean,
    data: {
        type: Object,
        default() {
            return {
                component: {
                    required: true
                },
                title:""
            }
        }
    }
})

</script>

<template>
    <VNavigationDrawer @update:model-value="rightDrawer.close()" class="text-h5" style="width:400px;" clipped location="right" :model-value="props.open" temporary :border="true" :elevation="10">
        <VContainer>
            <div class="text-center pb-4">{{props.data.title}}</div>
            <component @complete="performCallback" v-if="props.open" :is="props.data.component"></component>
        </VContainer>
    </VNavigationDrawer>
</template>