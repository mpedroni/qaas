<template>
  <the-container>
    <card :title="$route.name">
      <template #toolbar>
        <v-spacer />
        <btn color="primary" icon="fas fa-plus" label="Nova Dimensão" to="/dimensions/new" />
      </template>

      <v-card-text>
        <dimension-list @message="(message, status) => snackbar(message, status)" />
      </v-card-text>
    </card>

    <snackbar ref="snackbar" />
  </the-container>
</template>

<script>
import Btn from '@/components/QBtn';
import Card from '@/components/QCard';
import Snackbar from '@/components/QSnackbar';
import TheContainer from '@/components/TheContainer';

import DimensionList from './components/ListDimension';

export default {
  name: 'Dimensions',

  mounted() {
    this.getDimensions();
  },

  components: {
    Btn,
    Card,
    Snackbar,
    TheContainer,

    DimensionList,
  },

  data: () => ({
    dimensions: [],
    loading: true,
  }),

  computed: {
    snackbar() {
      return this.$refs.snackbar.show;
    },
  },

  methods: {
    async getDimensions() {
      try {
        const { data: dimensions } = await this.$api.get('dimensions');

        this.dimensions = dimensions;
      } catch {
        this.snackbar(
          'Algo de errado aconteceu ao carregar as dimensões. Tente novamente',
          'error'
        );
      }

      this.loading = false;
    },
  },
};
</script>
