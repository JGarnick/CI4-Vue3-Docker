<script setup>
    import {defineEmits, reactive, ref} from 'vue'
    import API from '@/services/api.js'
    import { useRightDrawerStore } from '../stores/rightDrawer';

    let emit = defineEmits(['complete'])
    const store = useRightDrawerStore()
    
    const list = store.data.list
    let todo = reactive({title:"", description:"", content:"", complete: false})
    
    async function submit(){
        list.id ? await API.patch("lists", list) : await API.post("lists", list)
        emit('complete')
    }

    function addItem(){
        list.todo_items.push({...todo})
        todo.title=""
        todo.description=""
        todo.content=""
        todo.complete=false
    }

    function removeItem(index){
        list.todo_items.splice(index, 1)
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
                        <VListItem v-for="(item, i) in list.todo_items" :key="i">
                            <template v-slot:prepend>
                                <VBtn @click="removeItem(i)" variant="text" color="error" size="" icon="mdi-delete-forever"></VBtn>
                            </template>
                            <VTextField
                                hide-details
                                style="min-height: 30px;" 
                                density="compact" 
                                :class="{'text-decoration-line-through': item.complete}"
                                class="pb-2"
                                v-model="item.title"></VTextField>
                            <VTextField
                                hide-details 
                                style="min-height: 30px;"  
                                density="compact" 
                                :class="{'text-decoration-line-through': item.complete}"
                                class="pb-2"
                                v-model="item.description"></VTextField>
                            <VTextarea
                                rows="2" 
                                density="compact" 
                                :class="{'text-decoration-line-through': item.complete}" 
                                v-model="item.content"></VTextarea>
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