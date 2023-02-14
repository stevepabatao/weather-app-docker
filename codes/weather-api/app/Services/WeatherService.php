<?php

namespace App\Services;

use App\Http\Repositories\WeatherRepository;
use App\Services\Contracts\ServiceInterface;

class WeatherService implements ServiceInterface
{
    protected $weatherRepository;

    public function __construct(WeatherRepository $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function getDataByCity($city)
    {
        return $this->weatherRepository->getWeatherByCity($city);
    }
}

