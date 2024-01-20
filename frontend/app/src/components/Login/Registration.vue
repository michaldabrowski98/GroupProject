<template>
    <v-container fluid style="height: 70vh">
      <v-sheet width="50%" class="mx-auto pa-12" rounded="true">
        <h1>Rejestracja</h1>
        <v-form fast-fail @submit.prevent="register">
          <v-text-field v-model="email" placeholder="email" :rules="emailRules" />
          <v-text-field v-model="password" placeholder="hasło" type="password" :rules="passwordRules" />
          <v-alert
              color="success"
              icon="$success"
              title="Sukces!"
              text="Rejestracja zakończona sukcesem."
              v-model="displaySuccess"
          ></v-alert>
          <v-alert
              color="error"
              icon="$error"
              title="Błąd!"
              text="Rejestracja nie powiodła się. Sprawdź dane."
              v-model="displayError"
          ></v-alert>
  
  
          <v-btn type="submit" block class="mt-2" style="background:#ee5a32">Załóż konto</v-btn>
        </v-form>
      </v-sheet>
    </v-container>
  </template>
  <script>
  import axios from "axios";
  export default {
    name: "RegistrationPage",
    data() {
      return {
        email: "",
        password: "",
        emailRules: [
          v => !!v || 'Pole email jest wymagane',
          v => /.+@.+\..+/.test(v) || 'Adres email musi być poprawny',
        ],
        passwordRules: [
          v => !!v || 'Pole hasło jest wymagane',
          v => v.length >= 6 || 'Hasło musi mieć przynajmniej 6 znaków',
        ],
        displayError: false,
        displaySuccess: false,
        message: "",
      }
    },
    methods: {
      register(e) {
        e.preventDefault();
        if (
            this.email.length === 0
            || this.password.length === 0
        ) {
          this.displayError = true;
        } else {
          axios.post("http://localhost:80/api/register", {
            email: this.email,
            password: this.password,
          }).then(
              () => {
                this.displaySuccess = true;
              }
          ).catch(
              () => {
                this.displayError = true;
                alert("BLAD");
              }
          );
        }
      }
    }
  }
  </script>
  
  <style scoped>
  </style>