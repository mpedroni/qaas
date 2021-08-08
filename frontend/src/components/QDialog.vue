<template>
  <v-dialog v-model="dialog" v-bind="$attrs" v-on="$listeners" :width="width">
    <v-card>
      <v-card-title class="text-h5 accent white--text font-weight-bold">
        {{ title }}

        <v-spacer />

        <v-btn icon dark @click="$emit('cancel')">
          <v-icon>fas fa-times</v-icon>
        </v-btn>
      </v-card-title>

      <v-card-text class="mt-2">
        <slot>
          {{ text }}
        </slot>
      </v-card-text>

      <v-divider />

      <v-card-actions>
        <v-spacer />
        <v-btn color="red" text @click="$emit('cancel')"> {{ cancelMessage }} </v-btn>
        <v-btn color="primary" text @click="$emit('confirm')"> {{ confirmMessage }} </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: 'QDialog',

  props: {
    cancelMessage: {
      type: String,
      default: 'Não',
    },

    confirmMessage: {
      type: String,
      default: 'Sim',
    },

    text: {
      type: String,
      default: '',
    },

    title: {
      type: String,
      default: '',
    },

    value: {
      type: Boolean,
      required: true,
    },

    width: {
      type: [Number, String],
      default: 800,
    },
  },

  computed: {
    dialog: {
      get() {
        return this.value;
      },
      set(status) {
        this.$emit('input', status);
      },
    },
  },
};
</script>
