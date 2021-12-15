import About from './components/pages/About.vue';
import Contact from './components/pages/Contact.vue';

/*export default {
    routes: [{
            path: '/about',
            component: About,
            name: 'about',

        },
        {
            path: '/contact',
            component: Contact,
            name: 'contact',

        },
    ]
};*/

export const routes = [{
        name: 'about',
        path: '/about',
        component: About
    },
    {
        path: '/contact',
        component: Contact,
        name: 'contact',
    }

];