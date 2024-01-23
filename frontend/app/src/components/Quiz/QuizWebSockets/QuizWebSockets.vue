<template>
  <li v-for="message in messages" :key="message">
    {{ message }}
  </li>
  <v-btn  block class="mt-2" style="background:#ee5a32" v-on:click="nextQuestion">Następne pytanie</v-btn>
</template>

<script>
export default {
  name: "QuizSolvePage",
  data() {
    return {
      message: '',
      messages: [],
      socket: null,
    };
  },
  mounted() {
    this.socket = new WebSocket('ws://localhost:3001');
    console.log("CONNECTED");
    this.socket.onmessage = (event) => {
      this.messages.push(event.data);
    };
  },
  methods: {
    sendMessage() {
      if (this.message.trim() !== '') {
        this.socket.send(this.message);
        this.message = '';
      }
    },
    nextQuestion() {
      console.log('karaluch');
      this.socket.send('Next');
    }
  },
}
</script>

<style scoped>

</style>