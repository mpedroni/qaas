<template>
  <the-container>
    <card :title="$route.name">
      <template #toolbar>
        <v-spacer />
        <btn color="primary" icon="fas fa-plus" label="Nova Dimensão" to="/dimensions/new" />
      </template>

      <v-card-text>
        <dimension-list :dimensions="dimensions" />
      </v-card-text>
    </card>
  </the-container>
</template>

<script>
import Btn from '@/components/QBtn';
import Card from '@/components/QCard';
import TheContainer from '@/components/TheContainer';
import DimensionList from './components/ListDimension';

export default {
  name: 'Questions',

  components: {
    Btn,
    Card,
    DimensionList,
    TheContainer,
  },

  data: () => ({
    dimensions: [
      {
        id: 1,
        name: 'Trabalho',
      },
      {
        id: 2,
        name: 'Bem-Estar',
      },
    ],
  }),
};
</script>
