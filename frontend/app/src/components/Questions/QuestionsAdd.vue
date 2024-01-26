<template>
    <div>
      <h1>Tworzenie Quizu</h1>
      <div>
        <v-container fluid style="height: 70vh">
          <v-sheet width="50%" class="mx-auto pa-12" rounded="true">
            <v-text-field type="text" placeholder="Nazwa Quizu" v-model="title" />
            <v-btn @click="addTitle" type="submit" block class="mt-2" style="background:#ee5a32">
              Zapisz nazwę Quizu
            </v-btn>
          </v-sheet>

          <v-sheet width="50%" class="mx-auto pa-12" rounded="true">
            <v-text-field type="text" placeholder="Link do obrazka" v-model="image" />
            <v-btn @click="addImage" type="submit" block class="mt-2" style="background:#ee5a32">
              Zapisz obrazek
            </v-btn>
          </v-sheet>

          <v-sheet width="50%" class="mx-auto pa-12" rounded="true">
            <v-text-field type="text" placeholder="Opis" v-model="description" />
            <v-btn @click="addDescription" type="submit" block class="mt-2" style="background:#ee5a32">
              Dodaj opis Quizu
            </v-btn>
          </v-sheet>
  
          <v-sheet width="50%" class="mx-auto pa-12" rounded="true">
            <v-btn @click="openQuestionDialog" type="submit" block class="mt-2" style="background:#ee5a32">
              Dodaj pytanie
            </v-btn>
  
            <v-dialog v-model="dialogVisible">
              <v-card>
                <v-card-title>
                  Dodaj pytanie 
                </v-card-title>
                <v-card-text>
                  <v-text-field type="text" label="Treść pytania" v-model="newQuestionInDialog" />
                </v-card-text>
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Odpowiedzi</th>
                    <th scope="col"></th>
                    <th scope="col">Poprawna?</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>
                        <v-text-field type="text" placeholder="Odpowiedź" v-model="answers" />
                    </td>
                    <td>
                        <input type="radio">
                    </td>
                    </tr>
                </tbody>
                </table>
                <v-card-actions>
                  <v-btn @click="closeQuestionDialog" >Zamknij</v-btn>
                  <v-btn @click="addQuestionInDialog" >Zapisz</v-btn>
                  <v-btn @click="addAnswerInDialog" >Dodaj Odpowiedź</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
  
            <div v-for="question in questions" :key="question.id">
              <h2>{{ question.content }}</h2>
            </div>
          </v-sheet>
        </v-container>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "QuestionsAdd",
    data() {
      return {
        newQuestionInDialog: "",
        newAnswerInDialog:"",
        title: "",
        description:"",
        questions: [
            {
                image:'',
                content:'',
                answers:[
                    {
                        content:'',
                        is_correct: false,
                        id:this.id++
                    }
                ]
            }
        ],
        dialogVisible: false,
      };
    },
    methods: {
      addTitle() {
        // todo
      },
      addDescription(){
        //todo
      },
      addImage(){
        //todo
      },
      openQuestionDialog() {
        this.dialogVisible = true;
      },
      closeQuestionDialog() {
        this.dialogVisible = false;
      },
      addAnswerInDialog(){
        this.questions.answers.push({
            content: this.newAnswerInDialog,
            is_correct: false
        });
      },
      addQuestionInDialog() {
        this.questions.push({
          content: this.newQuestionInDialog,
          id: this.questions.length + 1,
        });
        this.dialogVisible = false;
        this.newQuestionInDialog = ""; 
      },
    },
  };
  </script>
  
  <style scoped>
  </style>
  