<template>
  <div>
    <v-toolbar v-if="title" flat dense color="transparent">
      <v-toolbar-title class="grey--text text--darken-3 text-h4 font-weight-bold">
        {{ title }}
      </v-toolbar-title>
    </v-toolbar>
    <v-card v-bind="$attrs" v-on="$listeners" rounded>
      <slot />
    </v-card>
  </div>
</template>

<script>
export default {
  name: 'QCard',

  props: {
    title: {
      type: String,
      default: '',
    },
  },
};
</script>
