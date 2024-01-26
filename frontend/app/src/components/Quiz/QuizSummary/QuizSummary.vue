<template>
  <v-card
      max-width="800"
      class="mx-auto"
  >
    <v-container>
      <v-row dense v-if="quiz !== null">
        <v-col cols="12">
          <v-card
              theme="dark"
          >
            <v-card-title class="text-h5">
               Prawidłowe odpowiedzi {{ quiz.name }}
            </v-card-title>
            <v-card-subtitle>{{ quiz.description }}</v-card-subtitle>
            <v-list v-for="(question) in quiz.questions" v-bind:key="question">
              <v-list-item style="background: #adadad"><h3>{{question.content}}</h3></v-list-item>
              <v-list v-for="(answer) in question.answers" v-bind:key="answer">
                <v-list-item v-bind:class="{correct: answer.is_correct}">{{answer.content}}</v-list-item>
              </v-list>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
      <v-row dense v-if="quiz !== null">
        <v-col cols="12">
          <v-card
              theme="dark"
          >
            <v-card-title class="text-h5">
              Wyniki uczestników
            </v-card-title>
            <v-table theme="dark">
              <template v-slot:default>
                <thead style="background: #adadad">
                <tr>
                  <th class="text-left">Nazwa uczestnika</th>
                  <th class="text-left">Ilosć punktów</th>
                  <th class="text-left">Wynik procentowy</th>
                </tr>
                </thead>
                <tbody class="table-hover">
                <tr v-for="(score, username) in userScore" :key="score">
                  <td class="text-left">{{ username }}</td>
                  <td class="text-left">{{ score }}/{{quiz.questions.length}}</td>
                  <td class="text-left">{{ Math.round(score / quiz.questions.length * 100)}}</td>
                </tr>
                </tbody>
              </template>
            </v-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-card>

</template>

<script>
import axios from 'axios';
export default {
  name: "QuizSummary",
  data() {
  return {
    quiz: null,
    userScore: [],
    config: {
      headers: {
        "Authorization": `Bearer ${JSON.parse(sessionStorage.getItem('token'))}`
      }
    }
  }
  },
  mounted() {
    if (null == sessionStorage.getItem('token')) {
      this.$router.push('/login');
    }

    axios.get(`http://localhost:80/api/quiz/solve/`+ this.$route.params.token +`/data`, this.config)
        .then(response => {
          if (response.status !== 200) {
            this.$router.push('/');
          }
          this.quiz = response.data.quiz;
          this.userScore = response.data.user_score;
        })
        .catch( e => {
          console.log(e);
          this.$router.push('/');
        });
  },
}
</script>

<style>
.correct {
  background: #3adb76;
}
</style>