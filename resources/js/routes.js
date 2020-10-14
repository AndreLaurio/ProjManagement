import ExampleComponent from './components/ExampleComponent'

export default{
    mode: 'history',

    routes:[
        {
            path: '/home',
            name:'ExampleComponent',
            component: () => import('./components/ExampleComponent')
        },
        {
            path:'/',
            name:'Home',
            component: () => import('./views/Home')
        }
    ]
}