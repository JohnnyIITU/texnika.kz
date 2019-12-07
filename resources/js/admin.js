require('./bootstrap');

window.Vue = require('vue');

import axios from 'axios'

import VueAxios from 'vue-axios'

import VueMask from 'v-mask'

Vue.use(VueAxios, axios);

Vue.component('login', require('./components/admin/login.vue').default);

Vue.component('marks-list', require('./components/admin/dicti/marks/list').default);
Vue.component('marks-add', require('./components/admin/dicti/marks/new').default);
Vue.component('cities-list', require('./components/admin/dicti/cities/list').default);
Vue.component('cities-add', require('./components/admin/dicti/cities/new').default);
Vue.component('services-list', require('./components/admin/dicti/services/list').default);
Vue.component('services-add', require('./components/admin/dicti/services/new').default);
Vue.component('equipments-list', require('./components/admin/dicti/equipments/list').default);
Vue.component('equipments-add', require('./components/admin/dicti/equipments/new').default);

Vue.component('rent-list', require('./components/admin/announcements/rent').default);
Vue.component('service-list', require('./components/admin/announcements/service').default);
Vue.component('sale-list', require('./components/admin/announcements/sale').default);

Vue.component('users-list', require('./components/admin/users').default);

window.onload = function(){
    var app = new Vue({
        el: '#app',
    });
};