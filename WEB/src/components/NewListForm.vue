<script setup>
    import {ref, defineEmits, reactive} from 'vue'
    import API from '@/services/api.js'

    let emit = defineEmits(['complete'])

    let list = ref({title: "", description: "", todos:[]})
    let todo = reactive({title:"", description:"", content:"", complete: false})

    async function submit(){
        await API.post("lists", list.value)
        emit('complete')
    }

    function addItem(){
        list.value.todos.push({...todo})
        todo.title=""
        todo.description=""
        todo.content=""
        todo.complete=false
    }

    function removeItem(index){
        list.value.todos.splice(index, 1)
    }
</script>

<template>
    <VForm>
        <VRow>
            <VCol cols="12">
                <VTextField clearable v-model="list.title" label="Title"></VTextField>
                <VTextarea rows="1" no-resize clearable v-model="list.description" label="Description"></VTextarea>
            </VCol>
        </VRow>
        <VRow>
            <VCol>
                <p class="text-h6">Add Items</p>
            </VCol>
        </VRow>
        <VRow>
            <VCol cols="6">
                <VTextField clearable v-model="todo.title" variant="underlined" label="Title"></VTextField>
            </VCol>
            <VCol cols="6">
                <VTextField clearable v-model="todo.description" variant="underlined" label="Description"></VTextField>
            </VCol>
            <VCol cols="12">
                <VTextarea rows="2" no-resize clearable v-model="todo.content" variant="underlined" label="Content"></VTextarea>
            </VCol>
        </VRow>
        <VRow>
            <VCol cols="12" class="d-flex justify-end">
                <VBtn @click="addItem" size="x-small" icon="mdi-plus" color="amber" variant="flat"></VBtn>
            </VCol>
        </VRow>
        <VRow>
            <VCol cols="12" >
                <VCard>
                    <VList density="compact">
                        <v-list-subheader>ITEMS</v-list-subheader>
                        <VListItem v-for="(item, i) in list.todos" :key="i">
                            <template v-slot:prepend>
                                <VBtn @click="removeItem(i)" variant="text" color="error" size="" icon="mdi-delete-forever"></VBtn>
                            </template>
                            <VListItemTitle v-text="item.title"></VListItemTitle>
                            <VListItemSubtitle v-text="item.description"></VListItemSubtitle>
                            {{item.content}}
                        </VListItem>
                    </VList>
                </VCard>
            </VCol>
        </VRow>
        <VRow>
            <VCol>
                <VBtn @click.stop="submit" color="primary">Submit</VBtn>
            </VCol>
        </VRow>
    </VForm>
</template>