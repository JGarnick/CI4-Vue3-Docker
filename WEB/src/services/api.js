
const API = class{
    #base_url
    constructor(){
        this.base_url = import.meta.env.VITE_API_ENDPOINT;
    };

    async get(path){
        path = path.replace(/^\/+/, '');
        let response_data = await fetch(this.base_url + path)
            .then(re => re.json())
            .then(data => {
                console.log("Data:", data);
                return data;
            });
        console.log("Response Data:", response_data);
        return response_data;
    }
}

export default new API

// await fetch({
//     method: 'POST',
//     mode: 'cors',
//     headers: {
//         'Content-Type': 'application/json'
//     },
//     body: JSON.stringify(data)
// })
//     .then(re => re.json())
//     .then(data => console.log(data))