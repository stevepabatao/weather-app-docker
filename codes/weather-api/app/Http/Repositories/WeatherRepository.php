<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class WeatherRepository
{
    public function getWeatherByCity($city)
    {
        $weatherData = $this->fetchWeatherDataFromApi($city);

        return $this->formatWeatherData($weatherData);
    }

    private function fetchWeatherDataFromApi($city)
    {

        $apiKey = config('services.openweathermap.api_key');
        $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&cnt=5&appid=$apiKey";
        $weatherData = json_decode(file_get_contents($url), true);

        //dd($weatherData);

        return $weatherData;
    }

    private function formatWeatherData($weatherData)
    {
        return [
            'city' => $weatherData['name'],
            'country' => $weatherData['sys']['country'],
            'temperature' => $weatherData['main']['temp'],
            'temperature_min' => $weatherData['main']['temp_min'],
            'temperature_max' => $weatherData['main']['temp_max'],
            'pressure' => $weatherData['main']['pressure'],
            'humidity' => $weatherData['main']['humidity'],
            'wind' => $weatherData['wind']['speed'],
            'weather_type' => $weatherData['weather'][0]['main'],
            'description' => $weatherData['weather'][0]['description'],
            'icon' => $weatherData['weather'][0]['icon']
        ];
    }
}
