import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  {
    path: '/questions/new',
    name: 'Nova Pergunta',
    component: () => import(/* webpackChunkName: "new-question" */ '@/views/Questions/New'),
  },
];

const router = new VueRouter({
  routes,
});

export default router;
