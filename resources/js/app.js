
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('clients-component', require('./components/ClientsComponent.vue').default);
Vue.component('addresses-component', require('./components/AddressesComponent.vue').default);
Vue.component('roles-component', require('./components/RolesComponent.vue').default);
Vue.component('users-component', require('./components/UsersComponent.vue').default);
Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('show-component', require('./components/partials/ShowComponent.vue').default);
Vue.component('show-user-component', require('./components/partials/ShowUserComponent.vue').default);
Vue.component('pagination-component', require('./components/partials/PaginationComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Snotify, { SnotifyPosition } from 'vue-snotify'
const SnotifyOptions = {
    toast: {
        position: SnotifyPosition.rightTop
    }
}
Vue.use(Snotify, SnotifyOptions)

const app = new Vue({
    el: '#app',
    data: {
    	menu: 0
    }
});
