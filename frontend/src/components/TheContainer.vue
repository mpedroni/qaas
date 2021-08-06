<template>
  <v-container id="container">
    <slot />
  </v-container>
</template>

<script>
export default {
  name: 'TheContainer',
};
</script>

<style scoped>
#container {
  max-width: 70vw;
}
</style>
