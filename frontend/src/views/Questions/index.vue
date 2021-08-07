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
              item-text="name"
              clearable
            />
          </v-col>
        </v-row>
      </v-card-text>

      <v-card-text>
        <question-list :questions="handleQuestions" />
      </v-card-text>
    </card>
  </the-container>
</template>

<script>
import Btn from '@/components/QBtn';
import Card from '@/components/QCard';
import QSelect from '@/components/QSelect';
import TheContainer from '@/components/TheContainer';

import QuestionList from './components/ListQuestion';

export default {
  name: 'Questions',

  components: {
    Btn,
    Card,
    QSelect,
    TheContainer,

    QuestionList,
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
    filter: null,
    questions: [
      {
        id: 1,
        active: true,
        dimension: {
          id: 1,
          name: 'Trabalho',
        },
        text: 'Quantos dias na semana você prefere trabalhar em home-office?',
      },
      {
        id: 2,
        active: false,
        dimension: {
          id: 2,
          name: 'Bem-Estar',
        },
        text: 'De 0 a 10, como você avalia a sua disposição para o dia?',
      },
    ],
  }),

  computed: {
    handleQuestions() {
      return this.filter
        ? this.questions.filter(({ dimension }) => dimension.id === this.filter)
        : this.questions;
    },
  },
};
</script>
