<template>
  <the-container>
    <card :title="$route.name">
      <v-card-text>
        <form-dimension v-model="dimension" ref="form" @submit.prevent="submit">
          <v-row justify="center">
            <v-col cols="12" md="8" class="d-flex justify-end">
              <btn
                label="Salvar"
                color="primary"
                icon="$save"
                :block="mobile"
                type="submit"
                :loading="loading"
              />
            </v-col>
          </v-row>
        </form-dimension>
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

import FormDimension from '../components/FormDimension';

export default {
  name: 'NewDimensions',

  components: {
    Btn,
    Card,
    Snackbar,
    TheContainer,

    FormDimension,
  },

  data: () => ({
    dimension: {
      name: '',
    },
    loading: false,
    valid: true,
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

      this.$api
        .post('dimensions', this.dimension)
        .then(() => {
          this.snackbar('Dimensão criada com sucesso', 'success');
          this.$router.push('/dimensions');
        })
        .catch((error) => {
          this.snackbar(
            error.response.data.message || 'Não foi possível criar a dimensão. Tente novamente',
            'error'
          );
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>
