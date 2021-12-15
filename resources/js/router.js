import { createWebHistory, createRouter } from "vue-router";

import About from './components/pages/About.vue';
import Contact from './components/pages/Contact.vue';

export const routes = [{

        name: 'about',
        path: '/about',
        component: About
    },

    {
        name: 'contact',
        path: '/contact',
        component: Contact
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;