import config from "@/config/config";
import router from "@/router";
import axios from "axios";

const api = axios.create();

api.interceptors.request.use((config) => {
    if(localStorage.getItem('access_token')) {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
    }

    return config
}, error => {})


api.interceptors.response.use(response => response, (error) => {
    const originalRequest = error.config;

    if(error.response.data.message == "Token has expired") {
        return axios.post(`${config.api.url}/auth/refresh`, {}, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('access_token')}`
            }
        })
        .then(response => {
            localStorage.setItem('access_token', response.data.access_token)
            originalRequest.headers.authorization = `Bearer ${response.data.access_token}`
            
            return new Promise((resolve, reject) => {
                axios.request(originalRequest).then(response => {
                  resolve(response);
                }).catch((error) => {
                  reject(error);
                })
              });
        })
    }

    else if(error.response.status == 401)
        router.push('/')

})

export default api
