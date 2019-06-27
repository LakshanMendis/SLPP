/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */
import 'expose-loader?jQuery!jquery' // eslint-disable-line
import 'expose-loader?$!jquery' // eslint-disable-line

import './bootstrap';
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VCalendar from 'v-calendar';
import CKEditor from '@ckeditor/ckeditor5-vue';
import * as VueGoogleMaps from 'vue2-google-maps';
import Vuelidate from 'vuelidate';
import VueSweetalert2 from 'vue-sweetalert2';

// Route information for Vue Router
import Routes from 'RESO/js/routes.js';

// Store information for Vue Store
import Stores from 'RESO/js/stores';

// Component File
import App from 'RESO/js/views/App';

//Vue.use(Vuetify, VueAxios, axios);
Vue.use( BootstrapVue, VueAxios, axios );
Vue.use( CKEditor );
Vue.use( Vuelidate );
Vue.use( VueSweetalert2 );

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyB7OXmzfQYua_1LEhRdqsoYzyJOPh9hGLg',
    },
});

Vue.use(VCalendar, {
    firstDayOfWeek: 2,  // Monday
});

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
    router: Routes,
    store: Stores,
    render: h => h(App),
});

export default app;