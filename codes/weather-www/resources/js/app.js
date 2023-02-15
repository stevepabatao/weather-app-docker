import { createApp } from 'vue';

import Weather from './components/Weather';
import Recommendations from './components/Recommendations';
import SearchComponent from './components/SearchComponent';

require('./bootstrap');

const app = createApp({});

app.component('weather', Weather);
app.component('recommendations', Recommendations);
app.component('search-component', SearchComponent);

app.mount('#app');
