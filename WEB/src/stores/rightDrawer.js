import { defineStore } from 'pinia'


const defaultState = {
    title: "",
}
export const useRightDrawerStore = defineStore('rightDrawer', {
    state: () => ({
        isOpen: false,
        data: {
            title: "",
        },
    }),
    actions: {
        open(data){
            this.isOpen = true,
            this.data = data
        },
        close(){
            this.isOpen = false,
            this.data = defaultState
        }
    }
})