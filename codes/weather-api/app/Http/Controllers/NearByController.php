<?php

namespace App\Http\Controllers;

use App\Services\NearByService;

class NearByController extends Controller
{
    protected $nearbyService;

    public function __construct(NearByService $nearbyService)
    {
        $this->nearbyService = $nearbyService;
    }

    public function index($city)
    {
        $nearby = $this->nearbyService->getDataByCity($city);

        return response()->json($nearby);
    }
}

