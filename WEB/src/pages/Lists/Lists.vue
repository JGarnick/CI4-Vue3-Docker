<script setup>
import {ref} from "vue";
import API from "../../services/api"

let list = ref({title:"", description:""})
async function submitData(){
    await API.post("lists");
}
</script>

<template>
    <VForm>
        <VTextField
            v-model="list.title"
            label="Title"
        ></VTextField>
        <VBtn @click="submitData">Submit</VBtn>
    </VForm>
</template>