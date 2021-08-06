<template>
  <the-container>
    <card :title="$route.name">
      <v-card-text>
        <v-form v-model="valid" @submit.prevent="submit" ref="form">
          <v-row justify="center">
            <v-col cols="12" md="8">
              <text-input
                label="Dimensão"
                placeholder="Ex: Carreira"
                clearable
                :rules="[(v) => !!v || 'É necessário definir uma dimensão']"
              />
            </v-col>
          </v-row>

          <v-row justify="center">
            <v-col cols="12" md="8" class="d-flex justify-end">
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
import TextInput from '@/components/QTextInput';
import TheContainer from '@/components/TheContainer';

export default {
  name: 'NewDimensions',
  components: {
    Btn,
    Card,
    TextInput,
    TheContainer,
  },

  data: () => ({
    valid: true,
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

      console.log('store dimension and redirect to /dimensions (dimensions list)');
    },
  },
};
</script>
