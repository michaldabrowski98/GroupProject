<template>
  <v-card style="background: #3adb76" v-if="alert.length !== 0">
    Uczestnicy:
    <li v-for="(user) in alert.users" :key="user">
      {{ user }}
    </li>
  </v-card>

  <div class="text-center">
    <v-dialog
        v-model="dialog"
        activator="parent"
        width="auto"
    >
      <v-card>
        <v-card-text>
          Podaj nazwę użytkownika
        </v-card-text>
        <v-text-field
            v-model="username"
            density="compact"
        ></v-text-field>
        <v-card-actions>
          <v-btn color="primary" block @click="dialog = false" v-on:click="addUser">Zapisz</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
  <v-btn  block class="mt-2" style="background:#ee5a32" v-on:click="startQuiz" v-if="isAdmin">Start</v-btn>
  <v-container class="rectangle" v-if="message === 'starting'">
    <v-card
        class="mx-auto"
        max-width="600"
        hover
    >
      <v-card-item>
        <v-img
            :width="600"
            aspect-ratio="16/9"
            cover
            src="https://c.tenor.com/rec5dlPBK2cAAAAC/tenor.gif"
        ></v-img>
      </v-card-item>
      <v-card-item>
        <v-card-title>
          Zaraz zaczynamy
        </v-card-title>
        <v-card-text>
          Proszę czekać
        </v-card-text>
      </v-card-item>
    </v-card>
  </v-container>
  <v-container class="rectangle" v-else-if="message.length !== 0">
    <v-card
        class="mx-auto"
        max-width="600"
        hover
    >
      <v-card-item>
        <v-img
            :width="600"
            aspect-ratio="16/9"
            cover
            v-bind:src="message.image"
        ></v-img>
      </v-card-item>
      <v-card-item>
        <v-card-title>
          {{ message.content }}
        </v-card-title>
      </v-card-item>
      <li v-for="(answer) in message.answers" :key="answer.id">
        <v-btn style="width: 500px" v-bind:disabled="hasVoted" v-on:click="hasVoted = !hasVoted; sendAnswer(answer.id)">{{ answer.content }}</v-btn>
      </li>
    </v-card>
  </v-container>
  <v-container class="rectangle" v-else>
    <v-card
        class="mx-auto"
        max-width="600"
        hover
    >
      <v-card-item>
        <v-img
            :width="600"
            aspect-ratio="16/9"
            cover
            src="https://www.hubspot.com/hubfs/Smiling%20Leo%20Perfect%20GIF.gif"
        ></v-img>
      </v-card-item>
      <v-card-item>
        <v-card-title>
          Koniec
        </v-card-title>
        <v-card-text>
          Ukończyłes quiz, gratulacje!
        </v-card-text>
      </v-card-item>
    </v-card>
  </v-container>
  <div v-if="isAdmin">
    <v-btn  block class="mt-2" style="background:#ee5a32" v-on:click="nextQuestion" v-if="message.length !== 0 ">Następne pytanie</v-btn>
    <router-link :to="{ name: 'QuizSummary', params: { token: this.$route.params.token }}" v-if="message.length === 0">
      <v-btn  block class="mt-2" style="background:#ee5a32" v-on:click="endConnection">Zakończ</v-btn>
    </router-link>
  </div>

</template>


<script>
export default {
  name: "QuizSolvePage",
  data() {
    return {
      message: 'starting',
      alert: '',
      username: null,
      socket: null,
      quizStarted: false,
      dialog: this.username !== null,
      hasVoted: false,
      isAdmin: null !== sessionStorage.getItem('token')
    };
  },
  mounted() {
    this.socket = new WebSocket('ws://localhost:3001');
    console.log("CONNECTED");
    console.log(this.$route.params.token);
    this.socket.onmessage = (event) => {
      let data = JSON.parse(event.data);
      if (data.type === 'alert') {
        this.alert = data;
      } else {
        this.message = data
        this.hasVoted = false
      }
    };
  },
  methods: {
    nextQuestion() {
      this.socket.send(JSON.stringify({"type":"control", "action": "next"}));
    },
    startQuiz() {
      this.socket.send(JSON.stringify({"type":"control", "action": "start", "token": this.$route.params.token}));
      this.quizStarted = true;
    },
    addUser() {
      this.socket.send(JSON.stringify({"type":"user_connect", "action": "add_user", "username": this.username}));
    },
    sendAnswer(answerId) {
      this.socket.send(JSON.stringify(
            {
              "type":"answer",
              "action": "answer",
              "answer_id": answerId,
              "username": this.username,
              "token": this.$route.params.token
            }
          )
      );
    },
    endConnection() {
      this.socket.close();
    }
  },
}
</script>

<style scoped>

</style>