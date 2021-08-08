<template>
  <v-form v-model="valid" v-bind="$attrs" ref="form" @submit="$listeners.submit">
    <v-row>
      <v-col cols="12" md="8">
        <text-input
          v-model="question.text"
          label="Pergunta"
          placeholder="Ex: Você prefere trabalhar em home office ou presencial?"
          clearable
          :rules="[(v) => !!v || 'É necessário definir uma pergunta']"
        />
      </v-col>

      <v-col cols="12" md="4">
        <q-select
          v-model="question.dimension"
          label="Dimensão"
          no-data-text="Nenhuma dimensão encontrada"
          :items="dimensions"
          :loading="loading"
          item-text="name"
          return-object
          :rules="[(v) => !!(v && v.id) || 'É necessário definir a dimensão da pergunta']"
        />
      </v-col>
    </v-row>

    <slot />
  </v-form>
</template>

<script>
import TextInput from '@/components/QTextInput';
import QSelect from '@/components/QSelect';

export default {
  name: 'FormQuestion',

  components: {
    TextInput,
    QSelect,
  },

  props: {
    value: {
      type: Object,
      required: true,
    },
  },

  mounted() {
    this.getDimensions();
  },

  data: () => ({
    dimensions: [],
    loading: true,
    valid: true,
  }),

  computed: {
    question: {
      get() {
        return this.value;
      },

      set(question) {
        this.$emit('input', question);
      },
    },
  },

  methods: {
    async getDimensions() {
      this.loading = true;
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

    validate() {
      return this.$refs.form.validate();
    },
  },
};
</script>
