<template>
    <v-container class="rectangle">
      <v-table theme="dark">
        <template v-slot:default>
          <thead>
          <tr>
            <th class="text-left">Id</th>
            <th class="text-left">Tytuł</th>
            <th class="text-left">Ilość pytań</th>
            <th class="text-left">Data dodania</th>
            <th class="text-left">Akcje</th>
          </tr>
          </thead>
          <tbody class="table-hover">
          <tr v-for="(quiz,i) in quizes" :key="i">
            <td class="text-left">{{ quiz.id }}</td>
            <td class="text-left">{{ quiz.title }}</td>
            <td class="text-left">{{ quiz.questions_number }}</td>
            <td class="text-left">{{ quiz.created_at }}</td>
            <td class="text-left">
              <router-link :to="{ name: 'QuizSolve', params: { token: quiz.token }}">
                <v-btn style="background:#ee5a32" v-on:click="startQuiz(quiz.id)">Start</v-btn>
              </router-link>
            </td>
          </tr>
          </tbody>
        </template>
      </v-table>
    </v-container>
  </template>
  <script>
  import axios from 'axios';
  import { md5 } from 'js-md5';

  export default {
    name: "QuizList",
    data() {
      return {
        quizes: null,
        display: false,
        errors: [],
        config: {
          headers: {
            "Authorization": `Bearer ${JSON.parse(sessionStorage.getItem('token'))}`
          }
        }
      }
    },
    created() {
      if (null == sessionStorage.getItem('token')) {
        this.$router.push('/login');
      }

      axios.get(`http://localhost:80/api/quiz/list`, this.config)
          .then(response => {
            if (response.status !== 200) {
              this.$router.push('/');
            }
            this.quizes = response.data.quizes

            for (let i = 0; i < this.quizes.length; i++) {
              this.quizes[i].token = this.createToken(this.quizes[i].id);
            }
          })
          .catch( e => {
            this.errors.push(e)
            this.$router.push('/');
          });
    },
    methods: {
      createToken(id) {
        return md5(JSON.stringify({"id": id, "date": Date()}));
      },
      startQuiz(id, token) {
        axios.post(`http://localhost:80/api/quiz/solve/start`, {
          quiz_id: id,
          password: token,

          headers: {
            "Authorization": `Bearer ${JSON.parse(sessionStorage.getItem('token'))}`
          }
        })
            .then(response => {
              if (response.status !== 200) {
                this.$router.push('/');
              }
              this.quizes = response.data.quizes
            })
            .catch( e => {
              this.errors.push(e)
              this.$router.push('/');
            });
      }
    }
  }
  </script>

  <style scoped>
  </style>