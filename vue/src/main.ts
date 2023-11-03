import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import api from "@/plugins/api";
import axios from "axios";
import './style.scss'

const app = createApp(App)

const pinia = createPinia();
pinia.use(({app, store}) => {
    return {
        api: app.config.globalProperties.$api,
    };
});
app.use(pinia)
const requestStore: any = {};
const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    withCredentials: true,
    headers: {
        "Accept": "application/json"
    }
});

app.use(router)
app.use(api, {axios: axiosInstance, requestStore});
app.mount('#app')
