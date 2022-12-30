import { defineStore } from 'pinia'

export const useSnackbarsStore = defineStore('snackbars', {
    state: () => ({
        location: "top",
        message: "This is a default alert",
        variant: "flat"
    }),
    actions: {
        trigger(){

        }
    }
})