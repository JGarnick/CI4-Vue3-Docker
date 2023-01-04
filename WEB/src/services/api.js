import useEventBus from "../composables/eventBus";
const {emit} = useEventBus()

const API = class{
    #base_url
    constructor(){
        this.base_url = import.meta.env.VITE_API_ENDPOINT;
    };

    async get(path){
        try{
            path = path.replace(/^\/+/, '');
            let response_data = await fetch(this.base_url + path)
                .then(re => re.json())
                .then(data => {
                    console.log("Data:", data);
                    return data;
                });
                
            emit("triggerToast", {type: 'success', text: response_data.details})
            return response_data.details;
        }catch(error){
            emit("triggerToast", {type: 'error', text: 'Hello World'})
        }
    }

    async post(path, data){
        try {
            path = path.replace(/^\/+/, '');
            let response_data = await fetch(this.base_url + path, {
                method: 'POST',
                mode: 'cors',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(re => re.json())
            .then(data => {
                console.log("Data:", data);
                return data;
            });
        
            return response_data.details;
        } catch (error) {
            
        }
    }
}

export default new API