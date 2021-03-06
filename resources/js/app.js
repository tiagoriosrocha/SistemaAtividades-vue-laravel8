/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import axios from 'axios'
import VueAxios from 'vue-axios'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faPlus, faArrowDown, faArrowUp, faPenToSquare, faTrash, faUserSecret, faMagnifyingGlass, faFloppyDisk, faCircleExclamation, faBomb, faMugHot, faClock, faMinus, faPlay, faPause } from '@fortawesome/free-solid-svg-icons'
import Vue from 'vue';

library.add(faUserSecret)
library.add(faPenToSquare)
library.add(faTrash)
library.add(faArrowUp)
library.add(faArrowDown)
library.add(faPlus)
library.add(faMinus)
library.add(faMagnifyingGlass)
library.add(faFloppyDisk)
library.add(faCircleExclamation)
library.add(faBomb)
library.add(faMugHot)
library.add(faClock)
library.add(faPlay)
library.add(faPause)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('frame-component', require('./components/FrameComponent.vue').default);
Vue.component('post-component', require('./components/PostComponent.vue').default);
Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('details-post-component', require('./components/ShowPostComponent.vue').default);
Vue.component('create-post-component', require('./components/CreatePostComponent.vue').default);
Vue.component('create-message-component', require('./components/CreateMessageComponent.vue').default);
Vue.use(VueAxios, axios);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
