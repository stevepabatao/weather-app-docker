<?php

namespace App\Services;

use App\Http\Repositories\NearByRepository;
use App\Services\Contracts\ServiceInterface;

class NearByService implements ServiceInterface
{
    protected $nearbyRepository;

    public function __construct(NearByRepository $nearbyRepository)
    {
        $this->nearbyRepository = $nearbyRepository;
    }

    public function getDataByCity($city)
    {
        return $this->nearbyRepository->getPlacesByCity($city);
    }
}
