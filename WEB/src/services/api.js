import useEventBus from "../composables/eventBus";
const {emit} = useEventBus()
const STRIP_SLASHES_PATTERN = "/^\/+|\/+$/"

const API = class{
    #base_url
    constructor(){
        this.base_url = import.meta.env.VITE_API_ENDPOINT;
    };

    async get(path){
        try{
            path = path.replace(STRIP_SLASHES_PATTERN, '');
            let response_data = await fetch(this.base_url + path)
                .then(re => re.json())
                .then(data => {
                    return data;
                });
                
            emit("triggerToast", {type: 'success', text: response_data.message})
            return response_data.data;
        }catch(error){
            emit("triggerToast", {type: 'error', text: 'There was a problem fetching the Entities'})
        }
    }

    async post(path, data){
        try {
            path = path.replace(STRIP_SLASHES_PATTERN, '');
            if (data.id) {
                path += `/${data.id}`
            }
            let response_data = await fetch(this.base_url + path, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(re => re.json())
            .then(data => {
                return data;
            });
        
            emit("triggerToast", {type: 'success', text: response_data.message})
        } catch (error) {
            emit("triggerToast", {type: 'error', text: 'There was an error creating the Entity'})
        }
    }
    async patch(path, data){
        try {
            path = path.replace(STRIP_SLASHES_PATTERN, '');
            if (data.id) {
                path += `/${data.id}`
            }
            let response_data = await fetch(this.base_url + path, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(re => re.json())
            .then(data => {
                return data;
            });
        
            emit("triggerToast", {type: 'success', text: response_data.message})
        } catch (error) {
            emit("triggerToast", {type: 'error', text: 'There was an error updating the Entity'})
        }
    }

    async destroy(path, id){
        try {
            path = path.replace(STRIP_SLASHES_PATTERN, '') + `/${id}`;
            console.log(path);
            let response_data = await fetch(this.base_url + path, {
                method: 'DELETE',
            })
            .then(re => re.json())
            .then(data => {
                return data;
            });
        
            emit("triggerToast", {type: 'success', text: response_data.message})
        } catch (error) {
            emit("triggerToast", {type: 'error', text: 'There was an error deleting the Entity'})
        }
    }
}

export default new API