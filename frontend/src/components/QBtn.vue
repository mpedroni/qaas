<template>
  <v-btn v-bind="$attrs" v-on="$listeners" outlined>
    <v-icon v-if="icon" left v-text="icon" />{{ label }}
  </v-btn>
</template>

<script>
export default {
  name: 'QBtn',

  props: {
    icon: {
      type: String,
      default: '',
    },
    label: {
      type: String,
      required: true,
    },
  },
};
</script>
