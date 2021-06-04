// require('./bootstrap');
import {createApp} from "vue";
import ManagerApp from "./components/App.vue";
import store from "./store";
import router from "./router";

const numeral = require('numeral');

const app = createApp(ManagerApp);

app.config.globalProperties.$filters = {
    numberFormat(value: any) {
        return numeral(value).format("0,0");
    }
};

app.use(store).use(router).mount('#manager-app');
