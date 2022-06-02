require('./bootstrap');

window.Vue = require('vue').default;
import Swal from 'sweetalert2';
import VueProgressBar from 'vue-progressbar';



import { Form,HasError,AlertError } from 'vform';

const options = {
    color: "#729fee",
    failedColor: '#874b4b',
    thickness: '10px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}

Vue.use(VueProgressBar, options);

window.Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

import Loading from 'vue-loading-overlay';
Vue.use(Loading);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('product-component', require('./components/ProductComponent.vue').default);


window.Form = Form;
window.Swal = Swal;
window.Toast = Toast;
window.VueProgressBar = VueProgressBar;


const app = new Vue({
    el: '#app',
});
