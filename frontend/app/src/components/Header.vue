<template>
  <v-app-bar>
    <v-app-bar-title>QuizApp</v-app-bar-title>
    <v-btn size="small" type="submit" style="background:#ee5a32">
        <router-link to="/login">Logowanie / Rejestracja</router-link></v-btn>
  </v-app-bar>
</template>

<script>
export default {
  name: 'HeaderComponent',
  props: {
    msg: String
  }
}
</script>

<style scoped>
</style>
