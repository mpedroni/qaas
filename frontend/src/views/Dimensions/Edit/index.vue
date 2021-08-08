<template>
  <the-container>
    <card :title="$route.name" :loading="loading">
      <v-card-text>
        <form-dimension v-model="dimension" ref="form" @submit.prevent="submit">
          <v-row justify="end">
            <v-col cols="12" md="auto">
              <btn
                label="Salvar"
                color="primary"
                icon="$save"
                :block="mobile"
                type="submit"
                :loading="saving"
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
  name: 'EditQuestions',

  components: {
    Btn,
    Card,
    Snackbar,
    TheContainer,

    FormDimension,
  },

  props: {
    // route query param
    dimensionId: {
      type: [String, Number],
      default: 0,
    },
  },

  mounted() {
    this.getDimension();
  },

  data: () => ({
    loading: true,
    saving: false,
    dimension: {},
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
    async getDimension() {
      try {
        const { data: dimension } = await this.$api.get(`dimensions/${this.dimensionId}`);

        this.dimension = dimension;
      } catch {
        this.snackbar('Algo de errado aconteceu ao carregar a dimensão. Tente novamente', 'error');
      }

      this.loading = false;
    },

    submit() {
      if (!this.$refs.form.validate()) {
        this.snackbar('Verifique os dados inseridos e tente novamente', 'error');
        return;
      }

      this.loading = true;
      this.saving = true;

      this.$api
        .put(`dimensions/${this.dimensionId}`, this.dimension)
        .then(() => {
          this.snackbar('Alterações salvas com sucesso', 'success');
          this.$router.push('/dimensions');
        })
        .catch((error) => {
          this.snackbar(
            error.response.data.message || 'Não foi possível salvar as alterações. Tente novamente',
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
