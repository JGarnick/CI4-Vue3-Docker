import { defineStore } from 'pinia'

export const useSnackbarsStore = defineStore('snackbars', {
    state: () => ({
        location: "top",
        message: "This is a default alert",
    }),
    actions: {
        trigger(type = "success", message = 'This is a snackbar message'){
            
        }
    }
})