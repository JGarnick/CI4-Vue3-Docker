<script setup>
import {ref, onMounted} from "vue";
import API from "../../services/api"

let lists = ref([])
onMounted(async ()=>{
    lists = await API.get("lists")
})

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
        <!-- <VWindowItem v-for="page in pages"> -->
            <VRow>
                <VCol cols="4" v-for="list in lists" :key="`list-${list.id}`">
                    <VCard>
                        <VExpandTransition>
                            <div v-show="expanded != list.id">
                                <VCardTitle>{{ list.title }}</VCardTitle>
                                <VCardSubtitle>{{ list.description }}</VCardSubtitle>
                                <VCardText class="d-flex">
                                    <span class="pr-3">Remaining: {{ list.todos.filter(t => !t.complete).length }}</span>
                                    <span class="pr-3">Completed: {{ list.todos.filter(t => t.complete).length }}</span>
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