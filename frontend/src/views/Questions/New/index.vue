<template>
  <the-container>
    <card :title="$route.name">
      <v-card-text>
        <form-question ref="form" @submit.prevent="submit">
          <v-row justify="end">
            <v-col cols="12" md="auto">
              <btn label="Salvar" color="primary" icon="$save" :block="mobile" type="submit" />
            </v-col>
          </v-row>
        </form-question>
      </v-card-text>
    </card>
  </the-container>
</template>

<script>
import Btn from '@/components/QBtn';
import Card from '@/components/QCard';
import TheContainer from '@/components/TheContainer';

import FormQuestion from '../components/FormQuestion';

export default {
  name: 'NewQuestions',
  components: {
    Btn,
    Card,
    TheContainer,

    FormQuestion,
  },

  data: () => ({
    valid: true,
    options: [
      {
        id: 1,
        name: 'Trabalho',
      },
    ],
  }),

  computed: {
    mobile() {
      return this.$vuetify.breakpoint.smAndDown;
    },
  },

  methods: {
    submit() {
      if (!this.$refs.form.validate()) {
        console.log('invalid form');
        return;
      }

      console.log('store question');
    },
  },
};
</script>
