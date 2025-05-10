import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap-icons/font/bootstrap-icons.css'
import 'bootstrap' 

import Vue3Toastify,  {toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.use(Vue3Toastify, {
    autoClose: 3000,
    position: "top-right",
    theme: "light"
    
})
app.config.globalProperties.$toast = toast
app.mount('#app')

