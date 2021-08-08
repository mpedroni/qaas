<template>
  <v-snackbar v-model="snackbar" right top rounded :color="color" :timeout="timeout">
    {{ message }}
  </v-snackbar>
</template>

<script>
export default {
  name: 'QSnackbar',

  data: () => ({
    snackbar: false,
    message: '',
    color: '',
    timeout: null,
  }),

  methods: {
    show(message, color, timeout = 5000) {
      this.message = message;
      this.color = color;
      this.timeout = timeout;

      this.snackbar = true;
    },
  },
};
</script>
