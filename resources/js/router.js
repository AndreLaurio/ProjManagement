import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const routes = [
    {
        path: '/home',
        name:'ExampleComponent',
        component: () => import('./components/ExampleComponent'),
        meta:{requiresAuth:true}
    },
    {
        path:'/',
        name:'Home',
        component: () => import('./views/Home')
    }
]

const router = new VueRouter({
    mode:'history',
    routes
})

export default router;