<template>
  <list>
    <template v-for="(dimension, index) in dimensions">
      <v-divider v-if="index" :key="`${index}_divider`" />

      <v-list-item :key="dimension.id" class="py-0">
        <v-list-item-content class="justify-center">
          <v-list-item-title v-text="dimension.name" />
        </v-list-item-content>

        <v-list-item-action>
          <v-btn icon color="red">
            <v-icon center>fas fa-trash</v-icon>
          </v-btn>
        </v-list-item-action>
      </v-list-item>
    </template>
  </list>
</template>

<script>
import List from '@/components/QList';

export default {
  name: 'DimensionList',

  components: {
    List,
  },

  props: {
    dimensions: {
      type: Array,
      required: true,
    },
  },
};
</script>
