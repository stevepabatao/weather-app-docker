<template>

    <div>

        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>

        <!-- Uncomment to debug
        <div v-if="weather">
            <div class="card bg-light mb-3">
                <div class="card-body">
                        <h4 class="card-title">Current Weather in : {{ weather.city }}</h4>
                        <p>Temperature: {{ weather.temperature }}</p>
                        <p>Temperature Max: {{ weather.temperature_max }}</p>
                        <p>Temperature MiN: {{ weather.temperature_min }}</p>
                        <p>Pressure: {{ weather.pressure }}</p>
                        <p>Humidity: {{ weather.humidity }}</p>
                        <p>Wind Speed: {{ weather.wind_speed }}</p>
                        <p>Weather Type: {{ weather.weather_type }}</p>
                        <p>Description: {{ weather.description }}</p>
                        <p>Icon: {{ weather.icon }}</p>
                </div>
            </div>
        </div>
        -->


    <!-- start -->
    <div class="container" id="wrapper">
        <div class="container-fluid" id="current-weather">
            <div class="row">

                <!-- Right panel -->
                <div class="col-md-4 col-sm-5">
                    <h5><span id="cityName">{{ city }}</span>, <span id="cityCode">{{ country }}</span></h5>
                    <h6 id="localDate">{{ formattedDate }}</h6>
                    <h5 id="localTime">{{ localTime }}</h5>
                </div>

                <!-- Center panel -->
                <div class="col-md-5 col-sm-7" style="margin: 10px auto;padding:0;">
                    <div class="center-row">
                        <i class="wi" :class="icon" id ="main-icon" style="font-size: 85px;"></i>
                        <div>
                            <span id="mainTemperature">{{ temp }}</span>
                            <p id="tempDescription">{{ tempDescription }}</p>
                        </div>
                        <p style="font-size: 1.1rem;">
                            <a href="#" class="active" id="celcius"  @click="toggleUnit(true)" :class="{ active: unitIsCelsius }">°C</a>  <a href="#" id="farenheit" @click="toggleUnit(false)" :class="{ active: !unitIsCelsius }">°F</a>
                        </p>
                    </div>
                </div>

                <!-- Left panel -->
                <div class="col-xs-12 col-sm-12 col-md-3 row" style="text-align: right;">
                    <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
                        <h6>Humidity: <span id="humidity">{{ humidity }}</span>%</h6>
                    </div>
                    <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
                        <h6>Wind: <span id="wind">{{ wind }}</span> m/s</h6>
                    </div>
                    <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
                        <h6>High: <span id="mainTempHot">{{ temp_high }}</span>°</h6>
                    </div>
                    <div class="col-md-12 col-sm-3 col-xs-3 side-weather-info">
                        <h6>Low: <span id="mainTempLow">{{ temp_low }}</span>°</h6>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- end -->
    </div>

</template>

<script>

    export default {
        name: 'Weather',
        data() {
            return {

                unitIsCelsius: true,
                city: '',
                weather: null,
                location: null,
                error: null,
                location_loading: false,
                loading: false,

                temp: '',
                tempDescription: '',
                humidity: '',
                wind: '',
                temp_high: 0,
                temp_low: 0,
                icon: '',
                time:'',

                weatherIconsMap : {
                    "01d": "wi-day-sunny",
                    "01n": "wi-night-clear",
                    "02d": "wi-day-cloudy",
                    "02n": "wi-night-cloudy",
                    "03d": "wi-cloud",
                    "03n": "wi-cloud",
                    "04d": "wi-cloudy",
                    "04n": "wi-cloudy",
                    "09d": "wi-showers",
                    "09n": "wi-showers",
                    "10d": "wi-day-hail",
                    "10n": "wi-night-hail",
                    "11d": "wi-thunderstorm",
                    "11n": "wi-thunderstorm",
                    "13d": "wi-snow",
                    "13n": "wi-snow",
                    "50d": "wi-fog",
                    "50n": "wi-fog"
                },

            };
        },
        created() {
            setInterval(() => {
                this.localTime = new Date().toLocaleTimeString();
            }, 1000);
        },

        computed: {
            formattedDate() {
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                return new Date().toLocaleDateString('en-US', options);
            },

            camelCaseText() {
                const arr = this.text.split(' ').map(sentence => {
                    return sentence.charAt(0).toUpperCase() + sentence.substring(1);
                });
                return arr.join(' ');
            },

            celsius() {
                return Math.round((this.temperature - 32) * (5/9));
            },

            fahrenheit() {
                const degrees = (this.temperature * 1.8) + 32;
                const rounded = Math.round(degrees);
                return rounded;
            }
        },

        methods: {

            startClock() {
                setInterval(() => {
                    this.localTime = new Date().toLocaleTimeString();
                }, 1000);
            },


            async getWeather() {
                try {
                    const response = await axios.get(`https://ipapi.co/json/`);
                    this.location = response.data;
                } catch (error) {
                    this.error = error.message;
                } finally {
                    this.location_loading = false;
                }

                this.error = null;
                this.weather = null;
                this.loading = true;
                this.location_loading = true;

                this.city = this.location.city;
                this.country = this.location.country;

                try {
                    const response = await axios.get(`http://api.weather.local/api/weather/${this.city}`);
                    this.weather = response.data;

                    console.log(this.weather);

                    this.temp = Math.round(this.weather.temperature);
                    this.tempDescription = this.weather.description;
                    this.humidity = this.weather.humidity;
                    this.wind = this.weather.wind;
                    this.temp_high = Math.round(this.weather.temperature_max);
                    this.temp_low = Math.round(this.weather.temperature_min);
                    this.icon = this.weatherIconsMap[this.weather.icon];
                    console.log("ICON : " + this.icon);

                } catch (error) {
                    this.error = error.message;
                } finally {
                    this.loading = false;
                }
            },

            toggleUnit(isCelsius) {
                if (this.unitIsCelsius !== isCelsius) {
                    this.unitIsCelsius = isCelsius;
                    this.temp = isCelsius ? this.toCelsius(this.temp) : this.toFahrenheit(this.temp);
                    this.temp_high = isCelsius ? this.toCelsius(this.temp_high) : this.toFahrenheit(this.temp_high);
                    this.temp_low = isCelsius ? this.toCelsius(this.temp_low) : this.toFahrenheit(this.temp_low);
                }
            },

            toCelsius(val) {
                return Math.round((val - 32) * (5/9));
            },

            toFahrenheit(val) {
                return Math.round(val * 1.8 + 32);
            }


        },

        mounted() {
            this.getWeather();
            console.log('Component mounted.');
        },

    };
</script>




