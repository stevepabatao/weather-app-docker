import { createApp } from 'vue';

import Weather from './components/Weather';
import SearchComponent from './components/SearchComponent';

require('./bootstrap');

const app = createApp({});

app.component('weather', Weather);
app.component('search-component', SearchComponent);

app.mount('#app');
