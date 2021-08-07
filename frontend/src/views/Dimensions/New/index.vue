<template>
  <the-container>
    <card :title="$route.name">
      <v-card-text>
        <form-dimension ref="form" @submit.prevent="submit">
          <v-row justify="center">
            <v-col cols="12" md="8" class="d-flex justify-end">
              <btn label="Salvar" color="primary" icon="$save" :block="mobile" type="submit" />
            </v-col>
          </v-row>
        </form-dimension>
      </v-card-text>
    </card>
  </the-container>
</template>

<script>
import Btn from '@/components/QBtn';
import Card from '@/components/QCard';
import TheContainer from '@/components/TheContainer';

import FormDimension from '../components/FormDimension';

export default {
  name: 'NewDimensions',

  components: {
    Btn,
    Card,
    TheContainer,

    FormDimension,
  },

  data: () => ({
    dimension: {
      name: '',
    },
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
