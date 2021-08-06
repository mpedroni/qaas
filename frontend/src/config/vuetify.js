import '@fortawesome/fontawesome-free/css/all.css';
import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);

const CUSTOM_ICONS = {
  save: 'fas fa-save',
};

const opts = {
  icons: {
    iconfont: 'fa',
    values: CUSTOM_ICONS,
  },
};

export default new Vuetify(opts);
