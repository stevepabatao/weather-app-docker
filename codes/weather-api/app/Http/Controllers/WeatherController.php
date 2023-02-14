<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index($city)
    {
        $weather = $this->weatherService->getDataByCity($city);

        return response()->json($weather);
    }
}

