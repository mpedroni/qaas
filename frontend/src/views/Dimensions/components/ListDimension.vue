<template>
  <v-skeleton-loader v-if="loading" type="list-item@5" />
  <list v-else>
    <template v-for="(dimension, index) in dimensions">
      <v-divider v-if="index" :key="`${index}_divider`" />

      <v-list-item :key="dimension.id" class="py-0">
        <v-list-item-content class="justify-center">
          <v-list-item-title v-text="dimension.name" />
        </v-list-item-content>

        <v-list-item-action>
          <v-tooltip top>
            <template #activator="{ attrs, on }">
              <v-btn icon color="red" v-bind="attrs" v-on="on" @click="deleteDimension(dimension)">
                <v-icon center>fas fa-trash</v-icon>
              </v-btn>
            </template>
            Excluir
          </v-tooltip>

          <v-tooltip top>
            <template #activator="{ attrs, on }">
              <v-btn
                v-bind="attrs"
                v-on="on"
                icon
                color="primary"
                :to="`/dimensions/${dimension.id}`"
              >
                <v-icon center>fas fa-pencil-alt</v-icon>
              </v-btn>
            </template>
            Editar
          </v-tooltip>
        </v-list-item-action>
      </v-list-item>
    </template>

    <v-list-item v-if="!dimensions.length">
      <v-list-item-content>
        <v-list-item-title> Nenhuma dimensão encontrada </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <q-dialog
      v-model="dialog"
      title="Excluir Dimensão"
      persistent
      text="Tem certeza que deseja excluir permanentemente essa dimensão?"
      @confirm="deleteDimension(deletingDimension), (dialog = false)"
      @cancel="(deletingDimension = 0), (dialog = false)"
    />
  </list>
</template>

<script>
import List from '@/components/QList';
import QDialog from '@/components/QDialog';

export default {
  name: 'DimensionList',

  components: {
    List,
    QDialog,
  },

  mounted() {
    this.getDimensions();
  },

  data: () => ({
    dialog: false,
    dimensions: [],
    deletingDimension: 0,
    loading: true,
  }),

  methods: {
    async deleteDimension({ id }) {
      if (!this.deletingDimension) {
        this.deletingDimension = id;
        this.dialog = true;
        return;
      }

      this.loading = true;

      try {
        await this.$api.delete(`dimensions/${this.deletingDimension}`);

        this.dimensions = this.dimensions.filter(
          (dimension) => dimension.id !== this.deletingDimension
        );

        this.snackbar('Dimensão excluída com sucesso', 'success');
      } catch (error) {
        this.snackbar(
          error.response.data.message || 'Não foi possível excluir a dimensão. Tente novamente',
          'error'
        );
      }

      this.deletingDimension = 0;

      this.loading = false;
    },

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

    snackbar(message, status) {
      this.$emit('message', message, status);
    },
  },
};
</script>
