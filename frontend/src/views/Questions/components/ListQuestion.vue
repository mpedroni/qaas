<template>
  <list>
    <template v-for="(question, index) in questions">
      <v-divider v-if="index" :key="`${index}_divider`" />

      <v-list-item :key="question.id">
        <v-list-item-avatar>
          <v-tooltip top>
            <template #activator="{ attrs, on }">
              <v-btn
                v-bind="attrs"
                v-on="on"
                @click="question.active = !question.active"
                icon
                :color="question.active ? 'green' : 'grey'"
                large
              >
                <v-icon>{{ question.active ? 'fas fa-check-circle' : 'far fa-circle' }}</v-icon>
              </v-btn>
            </template>
            {{ `Pergunta ${question.active ? 'Ativa' : 'Inativa'}` }}
          </v-tooltip>
        </v-list-item-avatar>

        <v-list-item-content class="justify-center">
          <v-row>
            <v-col
              v-text="question.dimension.name"
              cols="2"
              class="text-center overline font-weight-bold"
            />
            <v-col v-text="question.text" class="d-flex align-center" />
          </v-row>
        </v-list-item-content>

        <v-list-item-action>
          <v-tooltip top>
            <template #activator="{ attrs, on }">
              <v-btn icon color="red" v-bind="attrs" v-on="on">
                <v-icon center>fas fa-trash</v-icon>
              </v-btn>
            </template>
            Excluir
          </v-tooltip>

          <v-tooltip top>
            <template #activator="{ attrs, on }">
              <v-btn
                v-bind="attrs"
                v-on="on"
                icon
                color="primary"
                :to="`/questions/${question.id}`"
              >
                <v-icon center>fas fa-pencil-alt</v-icon>
              </v-btn>
            </template>
            Editar
          </v-tooltip>
        </v-list-item-action>
      </v-list-item>
    </template>
  </list>
</template>

<script>
import List from '@/components/QList';

export default {
  name: 'QuestionList',

  components: {
    List,
  },

  props: {
    questions: {
      type: Array,
      required: true,
    },
  },
};
</script>
