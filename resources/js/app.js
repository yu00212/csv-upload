import './bootstrap';
import "../css/app.css";

import { createApp } from "vue";
import App from "./example-component.vue";

const buildApp = async () => {
    const app = createApp(App);

    app.mount("#app");
};

buildApp();

