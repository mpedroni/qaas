<template>
  <the-container>
    <card :title="$route.name">
      <v-card-text>
        <dimension-list :dimensions="dimensions" />
      </v-card-text>
    </card>
  </the-container>
</template>

<script>
import Card from '@/components/QCard';
import TheContainer from '@/components/TheContainer';
import DimensionList from './components/DimensionList';

export default {
  name: 'Questions',

  components: {
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
