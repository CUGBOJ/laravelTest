/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

Vue = window.Vue = require('vue')

/**
 * Use iView
 */
import iView from 'iview'

Vue.use(iView)

import 'iview/dist/styles/iview.css'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('problem-table', require('./components/ProblemTable.vue'))
Vue.component('practice', require('./components/Practice.vue'))
Vue.component('status', require('./components/Status.vue'))
Vue.component('discuss', require('./components/Discuss.vue'))
Vue.component('code-editor', require('./components/CodeEditor.vue'))
Vue.component('login', require('./components/Login.vue'))
Vue.component('profile', require('./components/Profile.vue'))

/*eslint-disable no-unused-vars*/
window.bus = new Vue()

import router from './router'

const app = new Vue({
    router,
    el: '#app'
})
