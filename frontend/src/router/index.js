import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  {
    path: '/questions',
    name: 'Perguntas Cadastradas',
    component: () => import(/* webpackChunkName: "questions" */ '@/views/Questions'),
  },
  {
    path: '/questions/new',
    name: 'Nova Pergunta',
    component: () => import(/* webpackChunkName: "new-question" */ '@/views/Questions/New'),
  },

  {
    path: '/dimensions/new',
    name: 'Nova Dimensão',
    component: () => import(/* webpackChunkName: "new-dimension" */ '@/views/Dimensions/New'),
  },
];

const router = new VueRouter({
  routes,
});

export default router;
