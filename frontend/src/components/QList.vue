<template>
  <v-list v-bind="$attrs" v-on="$listeners" outlined rounded class="px-0">
    <slot />
  </v-list>
</template>

<script>
export default {
  name: 'QList',
};
</script>
