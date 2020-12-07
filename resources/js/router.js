import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const routes = [
    {
        path:'/',
        name:'Index',
        component: () => import('./views/Index')
    },
    {
        path:'/examination-room',
        name:'ExaminationRoom',
        component: () => import('./views/Examinee/ExaminationRoom')
    },
    {
        path:'*',
        name:'404',
        component: () => import('./views/404')
    }
]

const router = new VueRouter({
    mode:'history',
    routes
})

export default router;