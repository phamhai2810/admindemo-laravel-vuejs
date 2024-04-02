import { createApp } from 'vue';
import App from './App.vue';
import router from './router/index.js';
import axios from 'axios';
window.axios = axios;
import { createPinia } from 'pinia';
import '../src/css/customStyle.css';

import {Menu, List, Drawer, Button, message, Card, Table, Avatar, Select, Input, Checkbox, Modal } from 'ant-design-vue';
import 'bootstrap/dist/css/bootstrap-grid.min.css'
import 'bootstrap/dist/css/bootstrap-utilities.min.css'
import './css/customStyle.css'
import 'ant-design-vue/dist/reset.css';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(fas, fab, far);



const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router);
app.use(Button);
app.use(Modal);
app.use(Checkbox);
app.use(Select);
app.use(Input);
app.use(Drawer);
app.use(Avatar);
app.use(Card);
app.use(Table);
app.use(createPinia());
app.use(Menu);
app.use(List);
app.mount('#app');
app.config.globalProperties.$message = message;

