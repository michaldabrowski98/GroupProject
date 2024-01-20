import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHashHistory } from 'vue-router'
import HomePage from './components/HomePage'
import Login from "./components/Login/Login";
import Registration from "./components/Login/Registration";
import QuizList from "./components/Quiz/QuizList";

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        { path: '/', component: HomePage },
        { path: '/login', component: Login },
        { path: '/registration', component: Registration },
        { path: '/quizlist', component: QuizList },
    ]
})

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

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
