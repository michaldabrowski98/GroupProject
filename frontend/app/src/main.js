import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHashHistory } from 'vue-router'
import HomePage from './components/HomePage'
import QuestionsAdd from "@/components/Questions/QuestionsAdd.vue"
import Login from "./components/Login/Login";
import Registration from "./components/Login/Registration";
import QuizList from "./components/Quiz/QuizList";

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        { path: '/', component: HomePage },
        { path: '/questions', component: QuestionsAdd},
        { path: '/login', component: Login },
        { path: '/registration', component: Registration },
        { path: '/quizlist', component: QuizList },
        { path: '/quiz/solve/:token', name: 'QuizSolve', component: QuizWebSockets },
        { path: '/quiz/solve/:token/summary', name: 'QuizSummary', component: QuizSummary },
    ]
})

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import QuizWebSockets from "@/components/Quiz/QuizWebSockets/QuizWebSockets.vue";
import QuizSummary from "@/components/Quiz/QuizSummary/QuizSummary.vue";

const vuetify = createVuetify({
    ssr: true,
    components,
    directives,
    icons: { iconfont: 'mdi' },
    theme: {
        defaultTheme: 'dark'
    }
})

createApp(App).use(vuetify).use(router).mount('#app')
