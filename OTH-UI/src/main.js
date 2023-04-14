import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";

import "./assets/main.css";
import Navbar from "./components/Navbar.vue";
import Footer from "./components/Footer.vue"
import '@fortawesome/fontawesome-free/css/all.css'
const app = createApp(App);

app.component("Navbar", Navbar);
app.component("Footer", Footer);

app.use(createPinia());
app.use(router);

app.mount("#app");
