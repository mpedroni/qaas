import Vue from 'vue';
import App from './App.vue';
import vuetify from './config/vuetify';
import router from './router';
import api from './config/api';

Vue.config.productionTip = false;

Vue.prototype.$api = api;

new Vue({
  vuetify,
  router,
  render: (h) => h(App),
}).$mount('#app');
