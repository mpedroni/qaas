<template>
  <v-app id="app">
    <v-app-bar color="primary" app dark>
      <v-toolbar-title>qaas</v-toolbar-title>

      <v-spacer />

      <v-btn text to="/questions">Perguntas</v-btn>
      <v-btn text to="/questions/new">Criar Pergunta</v-btn>
      <v-btn text to="/dimensions/new">Criar Dimensão</v-btn>
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style scoped>
#app {
  background-color: #eee;
}
</style>
