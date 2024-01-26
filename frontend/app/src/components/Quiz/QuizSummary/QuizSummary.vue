<template>
  <h1>Podsumowanie</h1>
</template>

<script>
import axios from 'axios';
export default {
  name: "QuizSummary",
  data() {
  return {
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
        })
        .catch( e => {
          console.log(e);
          this.$router.push('/');
        });
  },
}
</script>

<style>

</style>