require('./bootstrap');

window.Vue = require('vue');

import router from './router';
import Vuetify from '../plugins/vuetify';

function isLoggedIn(){
    return localStorage.getItem('isLoggedIn')
}

router.beforeEach((to, from, next) => {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (isLoggedIn() != token) {
        next({
          path: '/',
        })
      } else {
        next()
      }
    } else {
      next() // make sure to always call next()!
    }
  })

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router
});
