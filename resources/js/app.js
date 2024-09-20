import 'normalize.css';

import { createApp } from 'vue';
import { createPinia } from 'pinia'

import App from "../js/src/App.vue";
import Router from '../js/src/router/router.js';
const pinia = createPinia()

createApp(App).use(pinia).use(Router).mount('#app');
