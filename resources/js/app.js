require('./bootstrap');

window.Vue = require('vue').default;
 
Vue.component('clima-component', require('./components/ClimaComponent.vue').default); 

const app = new Vue({
    el: '#app',
});
