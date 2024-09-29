import "./assets/global.css";
import { createApp } from "vue";
import { createPinia } from "pinia";
import { PrimeVue } from "@primevue/core";
import App from "./App.vue";
import router from "./router";
import ToastService from "primevue/toastservice";
import Aura from "@primevue/themes/aura";
import { definePreset } from "@primevue/themes";
const app = createApp(App);
const preset = definePreset(Aura,{
  components: {
    toast: {
      width: 'clamp(20rem,20vw + 10rem,25rem)'
    }
  }
});
app.use(PrimeVue, {
  theme: {
    preset: preset,
    options: {
      cssLayer: {
        name: "primevue",
        order: "global, primevue",
      },
      darkModeSelector: ".app-dark",
    },
    
  },
});
app.use(ToastService);
app.use(createPinia());
app.use(router);

app.mount("#app");
