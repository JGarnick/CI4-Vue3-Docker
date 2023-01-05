<script setup>
    import {ref, defineEmits} from 'vue'
    import API from '@/services/api.js'

    let emit = defineEmits(['complete'])

    let list = ref({title: "", description: ""})

    async function submit(){
        await API.post("lists", list.value)
        emit('complete')
    }
</script>

<template>
    <VForm>
        <VRow>
            <VCol cols="12">
                <VTextField v-model="list.title" label="Title"></VTextField>
                <VTextarea v-model="list.description" label="Description"></VTextarea>
            </VCol>
        </VRow>
        <VRow>
            <VCol>
                <VBtn @click.stop="submit" color="success">Submit</VBtn>
            </VCol>
        </VRow>
    </VForm>
</template>