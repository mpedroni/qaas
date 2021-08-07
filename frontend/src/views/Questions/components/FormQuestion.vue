<template>
  <v-form v-model="valid" v-bind="$attrs" v-on="$listeners" ref="form">
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
          :items="options"
          item-value="id"
          item-text="name"
          :rules="[(v) => !!v || 'É necessário definir a dimensão da pergunta']"
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
      default: () => ({}),
    },
  },

  data: () => ({
    options: [
      {
        id: 1,
        name: 'Trabalho',
      },
    ],
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
    validate() {
      return this.$refs.form.validate();
    },
  },
};
</script>
