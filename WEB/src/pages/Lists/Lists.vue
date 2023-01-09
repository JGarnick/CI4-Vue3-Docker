<script setup>
import {ref, onMounted, markRaw} from "vue";
import API from "../../services/api"
import {useRightDrawerStore} from '@/stores/rightDrawer.js'
import listForm from '@/components/ListForm.vue'


let lists = ref([])
const ListForm = markRaw(listForm)

const rightDrawer = useRightDrawerStore()
onMounted(()=>{
    updateLists()
})

async function updateLists(){
    lists.value = await API.get("lists")
}

function openListForm(list = false){
    let args = {
        component: ListForm,
        callback: ()=>updateLists(),
        title: "Create Todo List"
    }
    
    if (list) {
        args.title = "Edit Todo List"
        args.list = list
    }

    rightDrawer.open(args)
}

async function destroyList(id){
    await API.destroy("lists", id)
    updateLists()
}

async function changeItemStatus(list, itemId){
    //I cannot just pass the whole todo item with expected changes to this function because this fires before the prop changes for some reason
    //Very heavy workaround: pass up the parent list along with item.id. Find it in the List.todo_items, then make a shallow copy of the item and manually change
    //the 'complete' property before sending to API
 
    let item = {...list.todo_items.find(i=>i.id == itemId)}
    item.complete = !item.complete
    await API.patch("items", item)
}

let expanded = ref(null)
</script>

<template>
    <VWindow>
        <VRow>
            <VCol class="justify-center">
                <v-hover>
                    <template v-slot:default="{ isHovering, props }">
                        <VCard @click="openListForm" style="cursor:pointer;" :style="[isHovering ? 'background:#545454' : '']" v-bind="props" class="d-flex justify-center" width="150" height="200">
                            <VIcon class="pt-10" style="font-size: 3em;" color="amber">mdi-plus</VIcon>
                        </VCard>
                    </template>
                </v-hover>
            </VCol>
        </VRow>
        <!-- <VWindowItem v-for="page in pages"> -->
            <VRow>
                <VCol style="max-width:25%" cols="4" v-for="list in lists" :key="`list-${list.id}`">
                    <VCard>
                        <VExpandTransition>
                            <div v-show="expanded != list.id">
                                <VCardTitle class="d-flex justify-space-between">
                                    <div>{{ list.title }}</div>
                                    <VBtn icon="mdi-square-edit-outline" @click="openListForm(list)"></VBtn>
                                </VCardTitle>
                                <VCardSubtitle>{{ list.description }}</VCardSubtitle>
                                <VCardText class="d-flex">
                                    <span class="pr-3">Remaining: {{ list.todo_items ? list.todo_items.filter(t => !t.complete).length : 0 }}</span>
                                    <span class="pr-3">Completed: {{ list.todo_items ? list.todo_items.filter(t => t.complete).length : 0 }}</span>
                                </VCardText>
                            </div>
                        </VExpandTransition>
                        
                        <VCardActions class="justify-space-between">
                            <VBtn v-if="expanded != list.id" @click="expanded = list.id">View</VBtn>
                            <VBtn v-else-if="expanded == list.id" @click="expanded = null">Close</VBtn>
                            <VBtn color="red" @click="destroyList(list.id)" icon="mdi-delete-forever"></VBtn>
                        </VCardActions>

                        <VExpandTransition>
                            <div v-show="expanded == list.id">
                                <VCard>
                                    <VCardText>
                                        <VList density="compact" lines="three">
                                            <VListItem 
                                                v-for="todo in list.todo_items"
                                                :key="`todo-${todo.id}`"
                                                :title="todo.title"
                                                :subtitle="todo.description"
                                                :class="{'text-decoration-line-through': todo.complete}"
                                            >
                                                {{ todo.content }}
                                            <template v-slot:prepend="{  }">
                                                <VListItemAction start>
                                                    <VCheckboxBtn :true-value="1" :false-value="0" @update:modelValue="changeItemStatus(list, todo.id)" v-model="todo.complete"></VCheckboxBtn>
                                                </VListItemAction>
                                            </template>
                                            </VListItem>
                                        </VList>
                                    </VCardText>
                                    <VCardActions>
                                        <VBtn @click="expanded = null">Close</VBtn>
                                    </VCardActions>
                                </VCard>
                            </div>
                        </VExpandTransition>
                    </VCard>
                </VCol>
            </VRow>
        <!-- </VWindowItem> -->
    </VWindow>
</template>

<style scoped>

</style>