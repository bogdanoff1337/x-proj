import './bootstrap';

import { createApp } from 'vue';
import App from "../js/src/App.vue";
import Router from '../js/src/router/router.js';

createApp(App).use(Router).mount('#app');
