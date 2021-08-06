<template>
  <the-container>
    <card :title="$route.name">
      <v-card-text>
        <v-form v-model="valid" @submit.prevent="submit" ref="form">
          <v-row>
            <v-col cols="12" md="8">
              <text-input
                label="Pergunta"
                placeholder="Ex: Você prefere trabalhar em home office ou presencial?"
                clearable
                :rules="[(v) => !!v || 'É necessário definir uma pergunta']"
              />
            </v-col>

            <v-col cols="12" md="4">
              <q-select
                label="Dimensão"
                no-data-text="Nenhuma dimensão encontrada"
                :items="options"
                item-value="id"
                item-text="name"
                :rules="[(v) => !!v || 'É necessário definir a dimensão da pergunta']"
              />
            </v-col>
          </v-row>

          <v-row justify="end">
            <v-col cols="12" md="auto">
              <btn label="Salvar" color="primary" icon="$save" :block="mobile" type="submit" />
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </card>
  </the-container>
</template>

<script>
import Btn from '@/components/QBtn';
import Card from '@/components/QCard';
import QSelect from '@/components/QSelect';
import TextInput from '@/components/QTextInput';
import TheContainer from '@/components/TheContainer';

export default {
  name: 'NewQuestions',
  components: {
    Btn,
    Card,
    TextInput,
    QSelect,
    TheContainer,
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
