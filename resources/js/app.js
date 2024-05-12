import './bootstrap';
import { createApp } from 'vue';

import App2 from "./vue-routes/App.vue";
import router from './router';
import store from './stores';

// createApp(App).use(router).use(store).mount("#app");

const app=createApp(App2)
app.use(router)
app.use(store)
app.mount('#app');