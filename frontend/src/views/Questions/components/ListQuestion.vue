<template>
  <v-skeleton-loader v-if="loading" type="list-item-avatar@5" />

  <list v-else>
    <template v-for="(question, index) in handleQuestions">
      <v-divider v-if="index" :key="`${index}_divider`" />

      <v-list-item :key="question.id">
        <v-list-item-avatar>
          <v-tooltip top>
            <template #activator="{ attrs, on }">
              <v-btn
                v-bind="attrs"
                v-on="on"
                @click="changeQuestionStatus(question)"
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
              <v-btn icon color="red" v-bind="attrs" v-on="on" @click="deleteQuestion(question)">
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

    <v-list-item v-if="!handleQuestions.length">
      <v-list-item-content>
        <v-list-item-title> Nenhuma pergunta encontrada </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <q-dialog
      v-model="dialog"
      title="Excluir Pergunta"
      persistent
      text="Tem certeza que deseja excluir permanentemente essa pergunta?"
      @confirm="deleteQuestion(deletingQuestion), (dialog = false)"
      @cancel="(deletingQuestion = 0), (dialog = false)"
    />
  </list>
</template>

<script>
import List from '@/components/QList';
import QDialog from '@/components/QDialog';

export default {
  name: 'QuestionList',

  components: {
    List,
    QDialog,
  },

  model: {
    prop: 'loading',
    event: 'update:loading',
  },

  mounted() {
    this.getQuestions();
  },

  props: {
    filter: {
      type: Number,
      default: 0,
    },
    loading: {
      type: Number,
      default: 0,
    },
  },

  data: () => ({
    dialog: false,
    questions: [],
    deletingQuestion: 0,
  }),

  computed: {
    handleQuestions() {
      return this.filter
        ? this.questions.filter(({ dimension }) => dimension.id === this.filter)
        : this.questions;
    },
  },

  methods: {
    async changeQuestionStatus(question) {
      this.startLoading();
      try {
        const { data: questions } = await this.$api.put(`questions/${question.id}`, {
          ...question,
          active: !question.active,
        });

        this.questions = questions;

        this.snackbar('O status da pergunta foi atualizado com sucesso', 'success');
      } catch {
        this.snackbar('Não foi possível trocar o status da pergunta. Tente novamente', 'error');
      }

      this.finishLoading();
    },

    async deleteQuestion({ id }) {
      if (!this.deletingQuestion) {
        this.deletingQuestion = id;
        this.dialog = true;
        return;
      }

      this.startLoading();

      try {
        await this.$api.delete(`questions/${this.deletingQuestion}`);

        this.questions = this.questions.filter((question) => question.id !== this.deletingQuestion);

        this.snackbar('Pergunta excluída com sucesso', 'success');
      } catch {
        this.snackbar('Não foi possível excluir pergunta. Tente novamente', 'error');
      }

      this.deletingQuestion = 0;

      this.finishLoading();
    },

    async getQuestions() {
      this.startLoading();
      try {
        const { data: questions } = await this.$api.get('questions');

        this.questions = questions;
      } catch {
        this.snackbar(
          'Algo de errado aconteceu ao carregar as perguntas. Tente novamente',
          'error'
        );
      }

      this.finishLoading();
    },

    finishLoading() {
      this.$emit('update:loading', this.loading - 1);
    },

    snackbar(message, status) {
      this.$emit('message', message, status);
    },

    startLoading() {
      this.$emit('update:loading', this.loading + 1);
    },
  },
};
</script>
