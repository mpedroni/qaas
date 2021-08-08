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
    path: '/questions/:id',
    name: 'Editar Pergunta',
    component: () => import(/* webpackChunkName: "edit-question" */ '@/views/Questions/Edit'),
    props: (route) => ({
      questionId: route.params.id,
    }),
  },

  {
    path: '/dimensions',
    name: 'Dimensões Cadastradas',
    component: () => import(/* webpackChunkName: "dimensions" */ '@/views/Dimensions'),
  },
  {
    path: '/dimensions/new',
    name: 'Nova Dimensão',
    component: () => import(/* webpackChunkName: "new-dimension" */ '@/views/Dimensions/New'),
  },
  {
    path: '/dimensions/:id',
    name: 'Editar Dimensão',
    component: () => import(/* webpackChunkName: "edit-dimension" */ '@/views/Dimensions/Edit'),
    props: (route) => ({
      dimensionId: route.params.id,
    }),
  },
];

const router = new VueRouter({
  routes,
});

export default router;
