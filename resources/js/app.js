require('./bootstrap');

window.Vue = require('vue');


// Vue.component('homepage', require('./components/HomePage.vue'));


// const app = new Vue({
//     el: '#app'
// });

import feed from './components/Feed.vue';
import telainicial from './components/TelaInicial.vue';

const app = new Vue({
    el: '#app',
    components: {
        feed,
        telainicial
      }
    //render: h => h(homepage)
});
