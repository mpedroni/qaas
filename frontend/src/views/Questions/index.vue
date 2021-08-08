<template>
  <the-container>
    <card :title="$route.name">
      <template #toolbar>
        <v-spacer />
        <btn color="primary" icon="fas fa-plus" label="Nova Pergunta" to="/questions/new" />
      </template>

      <v-card-text>
        <v-row>
          <v-col cols="12">
            <q-select
              v-model="filter"
              :items="dimensions"
              label="Filtrar por Dimensão"
              no-data-text="Nenhuma dimensão encontrada"
              item-value="id"
              :loading="!!loading"
              item-text="name"
              clearable
            />
          </v-col>
        </v-row>
      </v-card-text>

      <v-card-text>
        <question-list
          :filter="filter"
          :loading.sync="loading"
          @message="(message, status) => snackbar(message, status)"
        />
      </v-card-text>
    </card>

    <snackbar ref="snackbar" />
  </the-container>
</template>

<script>
import Btn from '@/components/QBtn';
import Card from '@/components/QCard';
import QSelect from '@/components/QSelect';
import Snackbar from '@/components/QSnackbar';
import TheContainer from '@/components/TheContainer';

import QuestionList from './components/ListQuestion';

export default {
  name: 'Questions',

  components: {
    Btn,
    Card,
    QSelect,
    Snackbar,
    TheContainer,

    QuestionList,
  },

  mounted() {
    this.getDimensions();
  },

  data: () => ({
    dimensions: [],
    filter: null,
    loading: 0,
  }),

  computed: {
    snackbar() {
      return this.$refs.snackbar.show;
    },
  },

  methods: {
    async getDimensions() {
      this.loading++;
      try {
        const { data: dimensions } = await this.$api.get('dimensions');

        this.dimensions = dimensions;
      } catch {
        this.snackbar(
          'Algo de errado aconteceu ao carregar as dimensões. Tente novamente',
          'error'
        );
      }

      this.loading--;
    },
  },
};
</script>
