// This Code Use for  Vue 3 

import { createApp } from 'vue';
require('./bootstrap');
const app = createApp({});

app.component("app-component", require("./components/App.vue").default);
//app.component('body-component', require("./components/Body.vue").default);

app.mount("#app");

// For Vue 2 -  version change the calling Stye Old function was ---- below



/*require('./bootstrap');
window.Vue = require('vue').default; // Vue 3 change the calling Stye

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app-component', require('./components/ExampleComponent.vue').default);
Vue.component('body-component', require("./components/Body.vue").default);

const app = new Vue({
    el: "#app",
});*/