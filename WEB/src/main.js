import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import './style.css'
import App from './App.vue'

// Vuetify
import {vuetify} from './plugins/vuetify'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { 
            path: '/', 
            component: () => import('./pages/Dashboard.vue'),
        },
        {
            path: '/lists',
            component: () => import('./pages/Lists/Lists.vue')
        }
    ],
});

createApp(App).use(vuetify).use(router).mount('#app')
