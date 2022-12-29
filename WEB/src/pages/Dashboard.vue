<script setup>
import {ref} from "vue";
import API from "../services/api"

let list = ref({title:"", description:""})
async function submitData(){
    await API.get("/test");
}
</script>
<template>
    <div class="d-flex">
        <VForm>
            <VTextField
                v-model="list.title"
                label="Title"
            ></VTextField>
            <VBtn @click="submitData">Submit</VBtn>
        </VForm>
    </div>
</template>