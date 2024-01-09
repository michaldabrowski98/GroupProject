<template>
  <h1>User: {{userId}}</h1>
  <h1>Id: {{id}}</h1>
  <h1>Tytuł: {{title}}</h1>
  <h1>Ukończony: {{completed}}</h1>
</template>

<script>
import axios from 'axios';
export default {
  name: 'HomePage',
  data() {
    return {
      "userId": null,
      "id": null,
      "title": "",
      "completed": false
    }
  },
  created() {
    axios.get('https://jsonplaceholder.typicode.com/posts/1').then(
        response => {
          this.userId = response.data.userId;
          this.id = response.data.id;
          this.title = response.data.title;
          this.completed = response.data.completed;
          console.log(JSON.stringify(response))
        }
    );
  }
}
</script>

<style scoped>
</style>
