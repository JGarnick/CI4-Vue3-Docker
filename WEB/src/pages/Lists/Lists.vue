<script setup>
import {ref, onMounted, markRaw, reactive} from "vue";
import API from "../../services/api"
import {useRightDrawerStore} from '@/stores/rightDrawer.js'
import NewListForm from '@/components/NewListForm.vue'


let lists = reactive([])
const newListForm = markRaw(NewListForm)

const rightDrawer = useRightDrawerStore()
onMounted(()=>{
    updateLists()
})

async function updateLists(){
    lists = await API.get("lists")
    console.log(lists);
}

function openCreateForm(){
    rightDrawer.open({
        title: "Create Todo List",
        component: newListForm,
        callback: ()=>updateLists()
    })
}

//TODO: Get a real list of todos from the API
// let lists = ref([
//     {
//         title:"Mock 1",
//         id: 1,
//         description:"A todo list for stuff and things",
//         todos: [
//             {
//                 title: "The first thing",
//                 id: 1,
//                 complete: false,
//                 description: "There was more to the description, so here you go. There was more to the description, so here you go.",
//                 content: "Blah blah and blah. More blah, but not so much blah as to blah blah AND blah. Just the blah, really."
//             },
//             {
//                 title: "The second thing",
//                 id: 2,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The third thing",
//                 id: 3,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//         ]
//     },
//     {
//         title:"Mock 2",
//         id: 2,
//         description:"A todo list for stuff and things",
//         todos: [
//             {
//                 title: "The first thing",
//                 id: 4,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The second thing",
//                 id: 5,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The third thing",
//                 id: 6,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//         ]
//     },
//     {
//         title:"Mock 3",
//         id:3,
//         description:"A todo list for stuff and things",
//         todos: [
//             {
//                 title: "The first thing",
//                 id: 7,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The second thing",
//                 id: 8,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The third thing",
//                 id: 9,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//         ]
//     },
//     {
//         title:"Mock 4",
//         id: 4,
//         description:"A todo list for stuff and things",
//         todos: [
//             {
//                 title: "The first thing",
//                 id: 10,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The second thing",
//                 id: 11,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The third thing",
//                 id: 12,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//         ]
//     },
//     {
//         title:"Mock 5",
//         id: 5,
//         description:"A todo list for stuff and things",
//         todos: [
//             {
//                 title: "The first thing",
//                 id: 13,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The second thing",
//                 id: 14,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The third thing",
//                 id: 15,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//         ]
//     },
//     {
//         title:"Mock 6",
//         id:6,
//         description:"A todo list for stuff and things",
//         todos: [
//             {
//                 title: "The first thing",
//                 id: 16,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The second thing",
//                 id: 17,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//             {
//                 title: "The third thing",
//                 id: 18,
//                 complete: false,
//                 description: "There was more to the description, so here you go",
//                 content: ""
//             },
//         ]
//     },
// ])
let expanded = ref(null)
</script>

<template>
    <VWindow>
        <VRow>
            <VCol class="justify-center">
                <v-hover>
                    <template v-slot:default="{ isHovering, props }">
                        <VCard @click="openCreateForm" style="cursor:pointer;" :style="[isHovering ? 'background:#545454' : '']" v-bind="props" class="d-flex justify-center" width="150" height="200">
                            <VIcon class="pt-10" style="font-size: 3em;" color="amber">mdi-plus</VIcon>
                        </VCard>
                    </template>
                </v-hover>
            </VCol>
        </VRow>
        <!-- <VWindowItem v-for="page in pages"> -->
            <VRow>
                
                {{lists}}
                <VCol cols="4" v-for="list in lists" :key="`list-${list.id}`">
                    <VCard>
                        <VExpandTransition>
                            <div v-show="expanded != list.id">
                                <VCardTitle>{{ list.title }}</VCardTitle>
                                <VCardSubtitle>{{ list.description }}</VCardSubtitle>
                                <VCardText class="d-flex">
                                    <span class="pr-3">Remaining: {{ list.todos ? list.todos.filter(t => !t.complete).length : 0 }}</span>
                                    <span class="pr-3">Completed: {{ list.todos ? list.todos.filter(t => t.complete).length : 0 }}</span>
                                </VCardText>
                            </div>
                        </VExpandTransition>
                        
                        <VCardActions>
                            <VBtn v-if="expanded != list.id" @click="expanded = list.id">Expand</VBtn>
                            <VBtn v-else-if="expanded == list.id" @click="expanded = null">Close</VBtn>
                        </VCardActions>

                        <VExpandTransition>
                            <div v-show="expanded == list.id">
                                <VCard>
                                    <VCardText>
                                        <VList density="compact" lines="three">
                                            <VListItem 
                                                v-for="todo in list.todos"
                                                :key="`todo-${todo.id}`"
                                                :title="todo.title"
                                                :subtitle="todo.description"
                                                :class="{'text-decoration-line-through': todo.complete}"
                                            >
                                                {{ todo.content }}
                                            <template v-slot:prepend="{  }">
                                                <v-list-item-action start>
                                                    <v-checkbox-btn v-model="todo.complete"></v-checkbox-btn>
                                                </v-list-item-action>
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