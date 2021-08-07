<template>
  <v-form v-model="valid" v-bind="$attrs" v-on="$listeners" ref="form">
    <v-row justify="center">
      <v-col cols="12" md="8">
        <text-input
          v-model="dimension.name"
          label="Dimensão"
          placeholder="Ex: Carreira"
          clearable
          :rules="[(v) => !!v || 'É necessário definir uma dimensão']"
        />
      </v-col>
    </v-row>

    <slot />
  </v-form>
</template>

<script>
import TextInput from '@/components/QTextInput';

export default {
  name: 'FormDimension',

  components: {
    TextInput,
  },

  props: {
    value: {
      type: Object,
      default: () => ({}),
    },
  },

  data: () => ({
    valid: true,
  }),

  computed: {
    dimension: {
      get() {
        return this.value;
      },

      set(dimension) {
        this.$emit('input', dimension);
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
