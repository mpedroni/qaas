<template>
  <the-container>
    <card :title="$route.name">
      <v-card-text>
        <form-question v-model="question" ref="form" @submit.prevent="submit">
          <v-row justify="end">
            <v-col cols="12" md="auto">
              <btn label="Salvar" color="primary" icon="$save" :block="mobile" type="submit" />
            </v-col>
          </v-row>
        </form-question>
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

import FormQuestion from '../components/FormQuestion';

export default {
  name: 'NewQuestions',

  components: {
    Btn,
    Card,
    Snackbar,

    TheContainer,

    FormQuestion,
  },

  data: () => ({
    loading: false,
    question: {
      text: '',
      dimension: {},
    },
    saving: false,
  }),

  computed: {
    mobile() {
      return this.$vuetify.breakpoint.smAndDown;
    },

    snackbar() {
      return this.$refs.snackbar.show;
    },
  },

  methods: {
    submit() {
      if (!this.$refs.form.validate()) {
        this.snackbar('Verifique os dados inseridos e tente novamente', 'error');
        return;
      }

      this.loading = true;
      this.saving = true;

      this.$api
        .post('questions', this.question)
        .then(() => {
          this.snackbar('Pergunta criada com sucesso', 'success');
          this.$router.push('/questions');
        })
        .catch((error) => {
          this.snackbar(
            error.response.data.message || 'Não foi possível criar a pergunta. Tente novamente',
            'error'
          );
        })
        .finally(() => {
          this.loading = false;
          this.saving = false;
        });
    },
  },
};
</script>
