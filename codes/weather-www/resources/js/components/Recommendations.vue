<template>

        <div id="recommendationCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card-deck">

                        <div class="card" v-for="(item, index) in recommendations" :key="index">
                            <img :src="item.photos" class="card-img-top" alt="city 1">
                            <div class="card-body">
                                <h5 class="card-title">{{ item.name }}</h5>
                                <p class="card-text">{{ item.tips.text }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</template>

<script>

    export default {
        name: 'Recommendations',
        data() {
            return {
                lat: '',
                long: '',
                coordinates: '',
                recommendations: null,

            };
        },

        methods: {
            async getRecommendations() {
                try {
                    const response = await axios.get(`https://ipapi.co/json/`);
                    this.location = response.data;
                } catch (error) {
                    this.error = error.message;
                } finally {
                    this.location_loading = false;
                }

                this.lat = this.location['latitude'];
                this.lon = this.location['longitude'];

                this.coordinates = this.lat + "," + this.lon;

                try {
                    const response = await axios.get(`http://api.weather.local/api/nearby/${this.coordinates}`);
                    this.recommendations = response.data;

                } catch (error) {
                    this.error = error.message;
                } finally {
                    this.loading = false;
                }

                console.log(this.recommendations);
            }

        },

        mounted() {
            this.getRecommendations();
            console.log('Recommendation Component mounted.');
        },

    };
</script>
