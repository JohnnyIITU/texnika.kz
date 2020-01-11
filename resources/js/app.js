require('./bootstrap');

window.Vue = require('vue');

import axios from 'axios'

import VueAxios from 'vue-axios'

import VueMask from 'v-mask'

Vue.use(VueAxios, axios);

Vue.use(VueMask);

Vue.component('register', require('./components/registration/register.vue').default);

Vue.component('login', require('./components/registration/login.vue').default);

Vue.component('rent', require('./components/rent.vue').default);
Vue.component('sale', require('./components/sale.vue').default);
Vue.component('service', require('./components/service.vue').default);

Vue.component('rent-search', require('./components/rent-search').default);
Vue.component('sale-search', require('./components/sale-search').default);
Vue.component('service-search', require('./components/service-search').default);

Vue.component('rent-view', require('./components/rent-view').default);
Vue.component('sale-view', require('./components/sale-view').default);
Vue.component('service-view', require('./components/service-view').default);

Vue.component('upload-image', require('./components/upload_image').default);

window.onload = function(){
    var app = new Vue({
        el: '#app',
        methods : {
            preloader(show) {
                if(show)
                {
                    document.getElementById('preloader').style.display = 'flex';
                }
                else
                {
                    document.getElementById('preloader').style.display = 'none';
                }
            }
        }
    });
};
