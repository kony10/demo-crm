// This Code Use for  Vue 3 

require('./bootstrap');
import { createApp } from 'vue';
import router from './router'
import App from './components/App.vue';

//const app = createApp({});

const app = createApp(App);

//import * as VueRouter from 'vue-router';

//app.component("app-component", require("./components/App.vue").default);

/*const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    //routes: routes.routes,
    routes: routes,
});*/

//app.use(router).mount('#app');

app.use(router);
app.mount("#app");